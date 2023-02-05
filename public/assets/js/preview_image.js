const image = document.getElementById("image");
const image_preview = document.querySelector(".image-preview");

image.addEventListener("change", function () {
  const file = this.files[0];
  image_preview.classList.add("mb-3");
  image_preview.src = URL.createObjectURL(file);
});

function previewImage(idImage, classImgPrev) {
  const image = document.getElementById(idImage);
  const image_preview = document.querySelector(`.${classImgPrev}`);

  image.addEventListener("change", function () {
    const file = this.files[0];
    image_preview.classList.add("mb-3");
    image_preview.src = URL.createObjectURL(file);
  });
}
