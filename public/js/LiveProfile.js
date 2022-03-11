function previewImg() {
  const profile = document.querySelector('#profile');
  const imgPreview = document.querySelector('#imgPreview');

  const fileProfile = new FileReader();
  fileProfile.readAsDataURL(profile.files[0]);

  fileProfile.onload = function(e) {
    imgPreview.src = e.target.result;
  }
}

