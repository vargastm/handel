const slide = new Slide('.slide', '.slide-wrapper');
slide.init();

class Gallery {
  constructor() {
    this.gallery = document.querySelector('[data-gallery="gallery"]');
    this.galleryList = document.querySelectorAll('[data-gallery="list"]');
    this.galleryMain = document.querySelector('[data-gallery="main"]');

    this.changeImage = this.changeImage.bind(this);
  }

  changeImage({currentTarget}) {
    this.galleryMain.src = currentTarget.src;
  }

  addChangeEvent() {
    this.galleryList.forEach(img => {
      img.addEventListener('click', this.changeImage);
      img.addEventListener('mouseover', this.changeImage);
    })
  }

  init() {
    if(this.gallery) {
      this.addChangeEvent();
    }
  }
}

const gallery = new Gallery();
gallery.init();