// 1. slide-group
const slideGroup = document.querySelector('#slide-group');
const firtImg = slideGroup.firstElementChild;
const lastImg = slideGroup.lastElementChild;

let current = 1;
let timer;

    // 첫번째 이미지와 마지막 이미지 노드 복제하고, 각각 slideGroup 안에 넣어주기
let cloneFirst = firtImg.cloneNode(true);
let cloneLast = lastImg.cloneNode(true);

slideGroup.appendChild(cloneFirst);
slideGroup.insertBefore(cloneLast, slideGroup.firstElementChild);

const slideImg = document.querySelectorAll('.slide-img');

    // slideImg의 갯수에 맞게 slideGroup 너비 지정
slideGroup.style.width = slideImg.length * 100 + '%';
    // slideGroup의 처음 left값 지정
slideGroup.style.left = -(current * 100) + '%';

    // slideImg 각각의 너비와 left값 지정
slideImg.forEach((img, index) => {
    img.style.width = 100 / slideImg.length + '%';
    img.style.left = index * (100 / slideImg.length) + '%';
});

    // slide 이동 함수
function slideMove(imgNum) {
    slideGroup.style.transition = '0.5s';

    // imgNum의 숫자에 따라 slideGroup의 left값 지정
    slideGroup.style.left = -(imgNum * 100) + '%';
    // imgNum값을 current값으로 지정
    current = imgNum;

    // indicator 조절
    if(imgNum === 0) {
        indiOn(lis.length - 1);
    }else if(imgNum < slideImg.length - 1) {
        indiOn(imgNum - 1);
    }else {
        indiOn(0);
    }

    // 슬라이드가 맨 마지막에 도달하면, 첫번째로 다시 넘겨주기
    if(imgNum == slideImg.length - 1) {
        firstCurrent();
    }
}

    // 슬라이드를 맨 처음으로 다시 돌려주는 함수
function firstCurrent() {
    setTimeout(() => {
        slideGroup.style.transition = '0ms';    // transition을 0으로 지정해서 다시 돌아가는 과정이 보이지 않도록 함
        slideGroup.style.left = '-100%';
        current = 1;
    }, 500);
}

    // 슬라이드를 맨 마지막으로 다시 돌려주는 함수
function lastCurrent() {
    setTimeout(() => {
        let lastImgNum = slideImg.length - 2;

        slideGroup.style.transition = '0ms';
        slideGroup.style.left = `-${lastImgNum * 100}%`;
        current = lastImgNum;
    }, 500);
}

    // 슬라이드가 자동으로 돌아가게 해주는 함수
function startIt() {
    timer = setInterval(() => {
        slideMove(current + 1);
    }, 5000);
}
startIt();

    // 슬라이드를 멈추는 함수
function stopIt() {
    clearInterval(timer);
}


// 2. nav
const nav = document.querySelector('#nav');

    // nav에 마우스가 올려지면 슬라이드를 멈추고, 떨어지면 슬라이드를 다시 실행시킴
nav.addEventListener('mouseenter', stopIt);
nav.addEventListener('mouseleave', startIt);

    // nav 요소를 클릭하면 요소에 따라 다른 동작을 진행함
nav.addEventListener('click', (e) => {
    if(e.target.id === 'next') {
        // next를 클릭했을때
        slideMove(current + 1);
    }else {
        // prev를 클릭했을때
        if(current > 0) {
            slideMove(current - 1);
            if(current === 0) {
                lastCurrent();
            }
        }
    }
})


// 3. indicator
const indi = document.querySelector('#indicator');

    // 슬라이드 이미지의 갯수에 맞게 li 요소 생성
for(let i=0; i<(slideImg.length-2); i++) {
    const li = document.createElement('li');
    li.innerHTML = i;
    indi.appendChild(li);
}

const lis = document.querySelectorAll('#indicator > li');

    // 페이지 로드시 가장 첫번째 li에 클래스 on이 붙여져 있도록 지정함
lis[0].classList.add('on');

    // 모든 li의 클래스 'on'을 제거하고, 특정 li의 클래스만 'on'으로 지정함
function indiOn(num) {
    lis.forEach(li => li.classList.remove('on'));
    lis[num].classList.add('on');
}

    // indicator를 클릭하면 특정 위치의 슬라이드로 이동함
indi.addEventListener('click', (e) => {
    const num = Number(e.target.innerHTML) + 1;
    slideMove(num);
    current = num;
    indiOn(e.target.innerHTML);
})

    // indicator에 마우스를 올리면 슬라이드를 멈추고, 마우스를 떼면 슬라이드를 실행시킴
indi.addEventListener('mouseenter', stopIt);
indi.addEventListener('mouseleave', startIt);