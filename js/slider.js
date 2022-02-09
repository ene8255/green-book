const slideGroup = document.querySelector('#slide-group');
const firtImg = slideGroup.firstElementChild;
const lastImg = slideGroup.lastElementChild;

let current = 1;
let timer;

let cloneFirst = firtImg.cloneNode(true);
let cloneLast = lastImg.cloneNode(true);

slideGroup.appendChild(cloneFirst);
slideGroup.insertBefore(cloneLast, slideGroup.firstElementChild);

const slideImg = document.querySelectorAll('.slide-img');
slideGroup.style.width = slideImg.length * 100 + '%';
slideGroup.style.left = -(current * 100) + '%';
slideImg.forEach((img, index) => {
    img.style.width = 100 / slideImg.length + '%';
    img.style.left = index * (100 / slideImg.length) + '%';
});

function slideMove(imgNum) {
    slideGroup.style.transition = '0.5s';
    slideGroup.style.left = -(imgNum * 100) + '%';
    current = imgNum;
    if(imgNum == slideImg.length - 1) {
        firstCurrent();
    }
}

function firstCurrent() {
    setTimeout(() => {
        slideGroup.style.transition = '0ms';
        slideGroup.style.left = '-100%';
        current = 1;
    }, 500);
}

function startIt() {
    timer = setInterval(() => {
        slideMove(current + 1);
    }, 5000);
}
startIt();