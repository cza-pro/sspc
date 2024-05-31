<template>
  <div>
    <!-- Thumbnail Image -->
    <img :src="thumbnailSrc" @click="showModal = true" alt="Filter" class="thumbnail" />

    <!-- Modal -->
    <!-- @click.self="showModal = false" -->
    <div v-if="showModal" class="modal">
      <div class="modal-content">
        <!-- @click="showModal = false" -->
        <span class="close" v-if="!showConfirmation" @click="closeModal()">&times;</span>
        <div class="modal-container">
          <img :src="fullImageSrc" class="modal-image" />
          <!-- Confirmation Popup -->
          <div v-if="showConfirmation" class="confirm-modal">
            <div class="modal-confirm-content confirmation-content">
              <span class="close confirmation-close" @click="closeConfirmation">&times;</span>
              <p class="confirm-text">是否一併下載灰階版照片？</p>
              <button @click="downloadNormalVersion" class="cancel-button">不需要</button>
              <button @click="downloadBothVersions" class="confirm-button">是</button>
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
</template>

<script setup>
import { ref } from 'vue';

// Props for thumbnail and full-size image URLs
const props = defineProps({
  thumbnailSrc: String,
  fullImageSrc: String,
});

const showModal = ref(false);
const showConfirmation = ref(false);

const closeModal = () => {
  showModal.value = false;
  showConfirmation.value = false;
};

const confirmDownload = () => {
  showConfirmation.value = true;
};

const closeConfirmation = () => {
  showConfirmation.value = false;
};

const downloadNormalVersion = () => {
  downloadImage(props.fullImageSrc);
  closeModal();
};

const downloadBothVersions = () => {
  downloadImage(props.fullImageSrc);
  downloadGrayscaleImage(props.fullImageSrc);
  closeModal();
};

const downloadImage = (url) => {
  const link = document.createElement('a');
  link.href = url;
  link.download = url.split('/').pop();
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
};

const downloadGrayscaleImage = (url) => {
  const img = new Image();
  img.crossOrigin = 'Anonymous';
  img.src = url;
  img.onload = () => {
    const canvas = document.createElement('canvas');
    canvas.width = img.width;
    canvas.height = img.height;
    const ctx = canvas.getContext('2d');
    ctx.drawImage(img, 0, 0);

    // Apply grayscale filter
    const imgData = ctx.getImageData(0, 0, canvas.width, canvas.height);
    const data = imgData.data;
    for (let i = 0; i < data.length; i += 4) {
      const avg = (data[i] + data[i + 1] + data[i + 2]) / 3;
      data[i] = avg;
      data[i + 1] = avg;
      data[i + 2] = avg;
    }
    ctx.putImageData(imgData, 0, 0);

    // Create a temporary link to download the grayscale image
    canvas.toBlob((blob) => {
      const link = document.createElement('a');
      link.href = URL.createObjectURL(blob);
      link.download = 'grayscale_' + url.split('/').pop();
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    });
  };
};

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
</style>
