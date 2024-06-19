<?php

namespace App\Imports;

use App\Models\Grade;
use App\Models\Photo;
use App\Models\Topic;
use App\Models\Subject;
use App\Models\PhotoType;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;

class PhotoImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */

    public function collection(Collection $collection)
    {

        foreach($collection as $key => $row)
        {

            $subject = Subject::where('name', $row['subject'])->first();
            $grade = Grade::where('name', $row['grade'])->first();
            $topic = Topic::where('name', $row['topic'])->first();
            $photo_type = PhotoType::where('name', $row['photo_type'])->first();


            $spreadsheet = IOFactory::load(request()->file('import_file'));
            $i = 0;

            if ($spreadsheet->getActiveSheet()->getDrawingCollection()[$key] instanceof MemoryDrawing) {
                ob_start();
                call_user_func(
                    $spreadsheet->getActiveSheet()->getDrawingCollection()[$key]->getRenderingFunction(),
                    $spreadsheet->getActiveSheet()->getDrawingCollection()[$key]->getImageResource()
                );
                $imageContents = ob_get_contents();

                ob_end_clean();

                switch ($spreadsheet->getActiveSheet()->getDrawingCollection()[$key]->getMimeType()) {
                    case MemoryDrawing::MIMETYPE_PNG :
                        $extension = 'png';
                        break;
                    case MemoryDrawing::MIMETYPE_GIF:
                        $extension = 'gif';
                        break;
                    case MemoryDrawing::MIMETYPE_JPEG :
                        $extension = 'jpg';
                        break;
                }
            } else {
                $zipReader = fopen($spreadsheet->getActiveSheet()->getDrawingCollection()[$key]->getPath(), 'r');
                $imageContents = '';
                while (!feof($zipReader)) {
                    $imageContents .= fread($zipReader, 1024);
                }
                fclose($zipReader);
                $extension = $spreadsheet->getActiveSheet()->getDrawingCollection()[$key]->getExtension();
            }

            $myFileName = uniqid() . $key . '.' . $extension;

            $width = getimagesize($spreadsheet->getActiveSheet()->getDrawingCollection()[$key]->getPath())[0];
            $height = getimagesize($spreadsheet->getActiveSheet()->getDrawingCollection()[$key]->getPath())[1];

            Storage::disk('public')->put('import'. '/' . $myFileName, $imageContents, 'public');


            Photo::updateOrCreate([
                'name' => $row['name'],
                'generate_number' => mt_rand(100000000000, 999999999999),
                'subject_id' => $subject->id,
                'grade_id' => $grade->id,
                'topic_id' => $topic->id,
                'photo_type_id' => $photo_type->id,
                'photo_url' => "import/$myFileName",
                'photo_format' => $extension,
                'photo_size' => "$width" . "x" . "$height"
            ]);
        }



    }



}
