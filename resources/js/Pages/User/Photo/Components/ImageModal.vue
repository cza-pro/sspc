<template>
  <div class="photo-block">
    <div v-for="photo in tempResult" :key="photo" :class="((searchbar && searchbar === true) || (selectorBool && selectorBool === true))?'result-photo':'each-photo'">
      <!-- Thumbnail Image -->
      <div v-if="(searchbar && searchbar === true) || (selectorBool && selectorBool === true)" class="each-image">
        <div class="checked-css">
          <img v-if="photo.checkCondition" src="/images/checked.png" alt="checked" class="" @click="checkFunc(photo)" />
          <img v-else src="/images/uncheck.png" alt="uncheck" class="" @click="checkFunc(photo)" />
        </div>
        <div class="photo-block1">
          <img :src="photo.photo_url" @click="showModalFunc(photo)" alt="Filter" class="thumbnail" />
          <div class="photo-data">
            <p class="photo-title">{{photo.title}}</p>
            <p class="photo-content">{{photo.content}}</p>
          </div>
        </div>
      </div>
      <div v-else>
        <img :src="photo.photo_url" @click="showModalFunc(photo)" alt="Filter" class="thumbnail" />
      </div>

      <!-- Modal -->
      <!-- @click.self="showModal = false" -->
      <div v-if="showModal" class="modal">
        <div class="modal-content">
          <!-- @click="showModal = false" -->
          <span class="close" v-if="!showConfirmation" @click="closeModal()">&times;</span>
          <div class="modal-container">
            <img :src="popupImg.photo_url" class="modal-image" />
            <!-- Confirmation Popup -->
            <div v-if="showConfirmation" class="confirm-modal">
              <div class="modal-confirm-content confirmation-content">
                <span class="close confirmation-close" @click="closeConfirmation">&times;</span>
                <p class="confirm-text">是否一併下載灰階版照片？</p>
                <button @click="downloadNormalVersion(popupImg)" class="cancel-button">不需要</button>
                <button @click="downloadBothVersions(popupImg)" class="confirm-button">是</button>
              </div>
            </div>
          </div>
          
          <div class="download-row" @click="confirmDownload">
            <img src="/images/download.png" alt="download" class="download-img">
            <p class="download-css">
              下載
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div v-if="(searchbar && searchbar === true) || (selectorBool && selectorBool === true)" >
    <div class="right-btn">
      <div class="btn-block" @click="downloadFunc">
        <img src="/images/download-btn.png" alt="download" class="dl-css" />
        <p class="download-btn">下載({{count}})</p>
        <img src="/images/download-btn.png" alt="download" class="dl-css" style="visibility: hidden; " />
      </div>
    </div>

    <div>
      <el-pagination
        v-model:current-page="currentPage"
        v-model:page-size="resultsPerPage"
        :page-sizes="[2, 4, 6, 8]"
        :small="false"
        :disabled="false"
        :background="true"
        layout="prev, slot, next"
        :total="allResult.length"
        prev-text="上一頁"
        next-text="下一頁"
        @size-change="handleSizeChange"
        @current-change="handleCurrentChange"
      >
        <template v-slot>
          <div class="custom-sizes">
            <span>每頁顯示</span>
            <el-select v-model="resultsPerPage" placeholder="每頁顯示">
              <el-option
                v-for="size in [2, 4, 6, 8]"
                :key="size"
                :label="`${size}`"
                :value="size"
              />
            </el-select>
            <span>張</span>
          </div>
          <div class="custom-total">共 {{ allResult.length }} 頁</div>
        </template>
      </el-pagination>
    </div>

    <div v-if="selectedDL" class="modal">
      <div class="modal-confirm-content confirmation-content">
        <span class="close confirmation-close" @click="closeSelected">&times;</span>
        <p class="confirm-text">是否一併下載灰階版照片？</p>
        <button @click="dlSelectedOneVersion" class="cancel-button">不需要</button>
        <button @click="dlSelectedBothVersions" class="confirm-button">是</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, watch, computed, onMounted } from 'vue';

// Props for thumbnail and full-size image URLs
const props = defineProps({
  photos: {
    type: Object,
    default: {},
  },
  featureImgs: {
    type: Object,
    default: {},
  },
  searchbar: Boolean,
  selectorBool: Boolean
});

const currentPage = ref(1);
const allResult = ref(0);
const resultsPerPage = ref(4);
const tempResult = ref(0);
const showModal = ref(false);
const selectedDL = ref(false);
const showConfirmation = ref(false);
const selectedItems = ref([])
const count = ref(0);
const popupImg = ref('');

const totalPages = computed(() => {
  return Math.ceil(allResult.value / resultsPerPage.value);
});

const handleSizeChange = (newSize) => {
  resultsPerPage.value = newSize;
  paginationFunc();
};

const handleCurrentChange = (newPage) => {
  currentPage.value = newPage;
  paginationFunc();
};

const closeModal = () => {
  showModal.value = false;
  showConfirmation.value = false;
};
const showModalFunc = (val) => {
  showModal.value = true;
  popupImg.value = val
};

const confirmDownload = () => {
  showConfirmation.value = true;
};

const closeConfirmation = () => {
  showConfirmation.value = false;
};

const closeSelected = () => {
  selectedDL.value = false;
};

const checkFunc = (item) => {
  const index = tempResult.value.findIndex(result => result.id === item.id);
  if (index !== -1) {
    // Toggle the checkCondition property
    tempResult.value[index].checkCondition = !tempResult.value[index].checkCondition;
    if(tempResult.value[index].checkCondition == true) {
      count.value++;
    } else {
      count.value--;
    }
  } else {
    console.log("Item not found in the array");
  }
  console.log('Checked Item ', count.value)
};

const downloadNormalVersion = (val) => {
  const filename = `${val.name}`;
  downloadImage(val.photo_url, filename);
  closeModal();
};

const downloadBothVersions = async (val) => {
  const filename = `${val.name}`;
  downloadImage(val.photo_url, filename);
  
  // Convert to grayscale and download
  const grayscaleUrl = await convertToAllGrayscale(val);
  downloadImage(grayscaleUrl, `grayscale_${filename}`);
  closeModal();
};

const downloadFunc = () => {
  // Filter the props.photos array to get items where checkCondition is true
  selectedItems.value = tempResult.value
    .filter(item => item.checkCondition == true);
  selectedDL.value = true
};

const dlSelectedOneVersion = () => {
  selectedItems.value.forEach((url, index) => {
    const filename = `${url.name}`;
    downloadImage(url.photo_url, filename);
  });
  closeSelected();
};

const downloadImage = (url, filename) => {
  const link = document.createElement('a');
  link.href = url;
  // link.download = 'grayscale_' + url.split('/').pop();
  link.download = filename;
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
};

// Function to download all images in normal and grayscale versions
const dlSelectedBothVersions = async () => {
  for (const [index, url] of selectedItems.value.entries()) {
    const filename = `${url.name}`;
    // Download normal version
    downloadImage(url.photo_url, filename);
    // Convert to grayscale and download
    const grayscaleUrl = await convertToAllGrayscale(url);
    downloadImage(grayscaleUrl, `grayscale_${filename}`);
  }
  closeSelected();
};


// Function to convert an image to grayscale
const convertToAllGrayscale = (url) => {
  return new Promise((resolve, reject) => {
    const img = new Image();
    img.crossOrigin = 'Anonymous'; // Allow cross-origin images
    img.src = url.photo_url;
    img.onload = () => {
      const canvas = document.createElement('canvas');
      canvas.width = img.width;
      canvas.height = img.height;
      const ctx = canvas.getContext('2d');
      ctx.drawImage(img, 0, 0);
      const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
      const data = imageData.data;
      for (let i = 0; i < data.length; i += 4) {
        const avg = (data[i] + data[i + 1] + data[i + 2]) / 3;
        data[i] = avg;
        data[i + 1] = avg;
        data[i + 2] = avg;
      }
      ctx.putImageData(imageData, 0, 0);
      canvas.toBlob((blob) => {
        resolve(URL.createObjectURL(blob));
      });
    };
    img.onerror = () => {
      reject(new Error('Failed to load image'));
    };
  });
};

const paginationFunc = () => {
  // Calculate the start and end indices for the current page
  const startIndex = (currentPage.value - 1) * resultsPerPage.value;
  const endIndex = startIndex + resultsPerPage.value;

  // Slice the photos array to get the data for the current page
  let temp = allResult.value.slice(startIndex, endIndex);
  tempResult.value = temp;
}

// watch(() => resultsPerPage.value, (newValue) => {
//   handleSizeChange(newValue);
// });

// watch([() => resultsPerPage.value, () => props.photos], ([newResultsPerPage, newPhotos], [oldResultsPerPage, oldPhotos]) => {
//     handleSizeChange(newResultsPerPage);
    
//     console.log('Watch:', newPhotos);
// });


watch([() => resultsPerPage.value], ([newResultsPerPage], [oldResultsPerPage]) => {
  // Handle the changes in resultsPerPage
  handleSizeChange(newResultsPerPage);
});
watch([() => props.photos], ([newPhotos], [oldPhotos]) => {
    // Log the changes in props.photos
    console.log('Watch:', newPhotos);
    if((props.searchbar && props.searchbar === true) || (props.selectorBool && props.selectorBool === true)) {
      allResult.value = [...newPhotos]
      paginationFunc();
    } else {
      tempResult.value = [...props.featureImgs]
    }
});

onMounted(() => {
  if(!props.searchbar) {
    allResult.value = [...props.featureImgs]
    tempResult.value = [...props.featureImgs]
  } else {
    paginationFunc();
  }
})
</script>

<style scoped>
.thumbnail {
  cursor: pointer;
  width: 150px; /* Adjust as needed */
  height: auto;
  width: 100%;
}

.modal {
  display: flex;
  justify-content: center;
  align-items: center;
  position: fixed;
  z-index: 1000;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.8);
  backdrop-filter: blur(4px); /* Apply blur effect */
}
.confirm-modal {
  display: flex;
  justify-content: center;
  align-items: center;
  /* position: fixed; */
  position: absolute;
  z-index: 1000;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
}

.modal-content {
  /* position: relative;
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  text-align: center; */

  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}
.modal-confirm-content {
  position: relative;
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  text-align: center;
  /* margin: auto;
  display: block;
  width: 40%;
  max-width: 400px; */

  text-align: center;
  background: #F6C791;
  border-radius: 12px;
  padding: 3rem 1rem 1rem;
}

.close {
  position: absolute;
  top: 10px;
  right: 25px;
  color: #FFF;
  font-size: 35px;
  font-weight: normal;
  cursor: pointer;
}
.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}
.confirmation-content .confirmation-close {
  top: 10px;
  right: 25px;

  top: -7px;
  right: 10px;
  font-size: 30px;
}
.modal-container {
  position: relative;
}
.modal-image {
  width: 100%;
  height: auto;
  max-width: 60%;
  max-height: 80vh;
  margin: auto;
}
.download-row {
  display: flex;
  align-items: center;
  justify-content: center;
  margin-top: 1rem;
}
.download-img {
  width: 48px;
  height: 48px;
  cursor: pointer;
}
.download-css {
  font-weight: 700;
  font-size: 24px;
  color: #FFF;
  margin-left: 10px;
}

/* // */
.download-button, .confirm-button, .cancel-button {
  margin-top: 25px;
  padding: 10px 20px;
  background-color: #000;
  color: #fff;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  width: 100px;
  height: 36px;
  line-height: 18px;
  margin-left: 8px;
  cursor: pointer;
}
.cancel-button {
  margin-right: 8px;
}

.download-button:hover, .confirm-button:hover, .cancel-button:hover {
  /* background-color: #0056b3; */
}

/* Background blur */
.backdrop {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 1000; /* Ensure it is below the modal */
  background: rgba(0, 0, 0, 0.5);
  backdrop-filter: blur(10px); /* Apply blur effect */
}

.confirm-text {
  font-weight: 700;
  font-size: 24px;
  color: #000;
}
.photo-block {
  margin-left: 1rem;
}
.photo-block1 {
  margin-left: 1rem;
  box-shadow: 0px 2px 2px 0px #00000040;
}
.checked-css {
  width: 36px;
  height: 36px;
  min-width: 36px;
  cursor: pointer;
}
.uncheck-css {
}
.photo-data {
  font-weight: 400;
  font-size: 16px;
  color: #313131;
  padding: 1rem;
  height: 110px;
}
.photo-title {

}
.photo-content {

}
.each-image {
  display: flex;
  align-items: center;
}
.right-btn {
  display: flex;
  justify-content: end;
  margin: 3rem 0;
}
.btn-block {
  padding: 10px 0;
  width: 150px;
  border-radius: 6px;
  background: #FF7652;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0px 4px 2px 0px #0000002E;
  cursor: pointer;
}
.dl-css {
  width: 36px;
}
.download-btn {
  font-weight: 700;
  font-size: 20px;
  color: #FFF;
}
.demo-pagination-block + .demo-pagination-block {
  margin-top: 10px;
}
.demo-pagination-block .demonstration {
  margin-bottom: 16px;
}

/* Hide the default 'Total' text */
.el-pagination__total {
  display: none;
}

/* Style for the custom text */
.custom-sizes, .custom-total {
  font-weight: 400;
  font-size: 24px;
  color: #000;
  display: flex;
  align-items: center;
}
.custom-total {
  padding: 0 2rem;
}
</style>
<style>
  .el-select__suffix {
    background-image: url('/images/polygonimg.png');
    background-size: 100% 100%;
    width: 20px; /* Adjust icon size as needed */
    height: 20px;
  }
  .el-select__caret {
    display: none;
  }
  .btn-prev, .btn-next {
    border-radius: 6px !important;
    border: 3px solid #000 !important;
    font-weight: 400;
    font-size: 24px !important;
    color: #000 !important;
    padding: 1.5rem 1rem !important;
    width: 110px;
  }
  .btn-prev {
    margin-right: 2rem !important;
  }
  .btn-next {
    margin-left: 2rem;
  }
  .el-select__wrapper {
    border: 3px solid #000 !important;
    font-weight: 400;
    font-size: 24px !important;
    color: #000 !important;
    padding: 0.88rem 1rem !important;
  }
  .el-select__placeholder {
    color: #00A0FF !important;
  }
  .el-select {
    width: 110px !important;
    margin: 0 1rem;
  }
</style>
