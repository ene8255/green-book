# Green-Book

![Badge](https://img.shields.io/badge/PHP-777BB4.svg?&logo=PHP&logoColor=fff)
![Badge](https://img.shields.io/badge/CSS3-1572B6.svg?&logo=CSS3&logoColor=fff)
![Badge](https://img.shields.io/badge/JavaScript-F7DF1E.svg?&logo=JavaScript&logoColor=fff)
![Badge](https://img.shields.io/badge/AmazonAWS-232F3E.svg?&logo=AmazonAWS&logoColor=fff)
![Badge](https://img.shields.io/badge/MySQL-4479A1.svg?&logo=MySQL&logoColor=fff)
![Badge](https://img.shields.io/badge/Heroku-430098.svg?&logo=Heroku&logoColor=fff)

---
- 프로젝트 소요 기간: 14일
- 사이트 주소: https://green-book-i.herokuapp.com/
---

- PHP로 생성한 온라인 서점 형식의 프로젝트 사이트 입니다.
- Amazon RDS로 구축한 MySQL 데이터베이스를 사용하였고, 사이트 배포는 Heroku를 사용하였습니다.
<br/>   

- 구현한 기능
  + 베스트셀러를 분야별로 분류해서 보기 (GET)
  + 카트에 상품 담기, 카트에 담긴 상품 삭제하기
  + 회원가입, 로그인 하기
  + 로그인시 가능한 추가적 기능:   
    + 각 베스트셀러 상세 페이지에서 리뷰 쓰기
    + 마이페이지에서 비밀번호를 변경하거나 작성한 리뷰를 삭제할 수 있음
    + 각 상품의 가격이 10% 할인된 회원가로 표시됨   
  + 관리자 계정으로 로그인시 상품 추가(POST), 수정(UPDATE), 삭제(DELETE) 가능   
  
<br/>
 
> - 데이터베이스로부터 베스트셀러 데이터를 가져와서 화면에 나타내고, 분야를 선택하면 베스트셀러를 분야별로 분류해 볼 수 있습니다. (READ, GET)
> <img src='https://user-images.githubusercontent.com/86288109/163104272-783904e9-9575-43b6-9a27-d96cd695e934.gif' width='90%'>   
<br/>

> - SESSION을 활용하여 장바구니에 상품을 담고, 삭제할 수 있는 기능을 구현하였습니다.
> <img src='https://user-images.githubusercontent.com/86288109/157601649-7dcdd930-7dae-4c9f-9914-73306531b595.gif' width='90%'>   
<br/>

> - 사이트에 로그인을 한 경우에만 각 베스트셀러 상세 페이지에 리뷰 작성 form이 나타나고, 리뷰를 등록할 수 있습니다. (CREATE, POST)
> <img src='https://user-images.githubusercontent.com/86288109/157602148-2b682844-90d8-4fc5-92dd-08e8f332e5a2.gif' width='90%'>
<br/>

> - 마이페이지에서는 회뭔 정보와 작성한 리뷰 정보를 데이터베이스로부터 가져와서 나타냅니다. 
> - 마이페이지에서는 비밀번호를 변경할 수 있고, 작성한 리뷰를 삭제할 수 있는 기능이 있습니다. (DELETE)
> <img src='https://user-images.githubusercontent.com/86288109/157602294-a7ac3296-a4f1-499c-baba-bc8f1a6bbbef.gif' width='90%'>
<br/>

> - 관리자 계정으로 로그인한 경우에만 새 상품 추가(CREATE, POST), 상품 정보 수정(UPDATE), 상품 삭제(DELETE)가 가능합니다.
> <img src='https://user-images.githubusercontent.com/86288109/157603513-d7c7dd16-1e47-47e6-ac39-0ca12d6a45df.gif' width='90%'>
> <img src='https://user-images.githubusercontent.com/86288109/157603686-8585e837-da6c-47d7-aa63-1fe058c13a6d.gif' width='90%'>
