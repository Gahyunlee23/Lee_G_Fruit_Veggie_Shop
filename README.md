# 청과물 실시간 가격 조회 API
실시간 청과물 가격을 조회할 수 있는 API 중계 웹 서버 어플리케이션을 개발. 
유저는 브라우저 화면에서 청과물의 분류를 선택한 뒤, 이름을 입력하여 현재 가격을 조회할 수 있습니다.
별도로 제공된 과일가게 및 채소가게의 API를 사용하여 구현 했습니다.
브라우저에서는 과일가게 및 채소가게 API를 호출하지 않으며 WAS가 제공하는 브라우저 화면은 필요한 최소한만 구현되어 있습니다.

## Getting Started

개발시에 사용한 언어는 PHP 입니다. 

### Installing
프로젝트 설치

* 프로젝트 설치를 원하는 디렉토리에 cd 해주세요
* 프로젝트를 clone 받아주세요. github repo clone도 가능 합니다
* 이제 프로젝트 소스 코드에도 접근할 수 있습니다.

프로젝트 실행을 위한 docker 설치
* 맥일 경우, 우선 docker를 설치해주세요.
  [docker 설치 가이드](https://docs.docker.com/desktop/mac/install/)
 1. terminal을 열어 주세요
 2. 위에서 다운로드 받은 프로젝트 디렉토리로 cd 해주세요.
 3. docker-compose up 해주세요.
    3-1. docker.yml 파일에 제가 설정한 로컬 포트가 이미 사용 중일 가능성도 있습니다.(port is already taken || port is already allocated)
    3-2. 위의 경우에는 docker-compose.yml 파일을 열어 services 의 port를 변경해주세요.
    
* 윈도우일 경우, 설치되어 있는 종류에 따라 도커 설치가 어려울 수 있습니다.
1. [docker 설치 가이드](https://docs.docker.com/desktop/windows/install/)


## Versioning

[SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/your/project/tags). 

## Authors

* **이가현** - *Back End Developer* - [GitHub](https://github.com/Gahyunlee23)

## Acknowledgments

* [php.net](https://www.php.net/)
