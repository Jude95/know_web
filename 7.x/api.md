
#逼乎API文档

###规则
1. 所有接口POST，参数 x-www-form-urlencoded模式，返回json。

2. 响应状态：
	+ 200 —— 成功
	+ 400 —— 参数错误
	+ 401 —— 用户认证错误

3. 为方便开发学习，info输出sql语句。
4. 登录后用token代表用户。


###1. 注册
地址：http://redrock.alien95.cn/know/register.php
参数：

>name:  
>password:

返回：

```json
{
  "status": 200,
  "info": "success",
  "data": {
    "id": 1,
    "username": "admin",
    "password": "admin",
    "avatar": null,
    "token": "00309c36f7166d1c4c045682e7f949cb9c9edc9a"
  }
}
```

###2. 登录
地址：http://redrock.alien95.cn/know/login.php
参数

>name:  
>password:

返回：

```json
{
  "status": 200,
  "info": "success",
  "data": {
    "id": 1,
    "username": "admin",
    "avatar": null,
    "token": "6c5f989bdc56fe25f8a2b08443f354c910280c50"
  }
}
```

返回用户信息及token。

###3. 修改头像
地址：http://redrock.alien95.cn/know/modifyFace.php
参数

>token:  
>face:

传用户头像地址。本API不负责图片文件储存，图片储存请右转阿里，七牛，然后把图片地址传上来。

返回

```json
{
  "status": 200,
  "info": "success"
}
```

###4. 取问题列表
地址：http://redrock.alien95.cn/know/getQuestionList.php
参数

>page:  
>count:可空，每页条数，默认20条。

返回

```json
{
  "status": 200,
  "info": "success",
  "data": {
    "totalCount": 3,
    "totalPage": 1,
    "questions": [
      {
        "id": 3,
        "title": "哦哈哟",
        "content": "起床啦",
        "date": "2016-12-15 11:53:41",
        "recent": null,
        "answerCount": 0,
        "uid": 1,
        "authorName": "admin",
        "authorAvatar": ""
      },
      {
        "id": 2,
        "title": "test",
        "content": "testquestion",
        "date": "2016-12-15 11:53:09",
        "recent": null,
        "answerCount": 0,
        "uid": 1,
        "authorName": "admin",
        "authorAvatar": ""
      },
      {
        "id": 1,
        "title": "test",
        "content": "test",
        "date": "2016-12-15 11:48:33",
        "recent": null,
        "answerCount": 0,
        "uid": 1,
        "authorName": "admin",
        "authorAvatar": ""
      }
    ],
    "curPage": 0
  }
}
```

recent表示最近回复时间，没有回复时为null。

###5. 取回答列表
地址：http://redrock.alien95.cn/know/getAnswerList.php
参数：

>page:  
>questionId:  
>count:可空，每页条数，默认20条
>desc:可空，是否倒序，填true 或 false

返回：
```json
{
  "status": 200,
  "info": "success",
  "data": {
    "totalCount": 1,
    "totalPage": 1,
    "answers": [
      {
        "id": 1,
        "content": "蛤?",
        "date": "2016-12-15 12:17:10",
        "authorId": 1,
        "authorName": "admin",
        "authorAvatar": ""
      }
    ],
    "curPage": 0
  }
}
```

```json
{
  "status": 200,
  "info": "success",
  "data": {
    "totalCount": 0,
    "totalPage": 1,
    "answers": null,
    "curPage": 0
  }
}
```

###6. 发布问题
地址：http://redrock.alien95.cn/know/question.php
参数：

>title:  
>content:  
>token:

返回：

```json
{
  "status": 200,
  "info": "success"
}
```

###7. 发布回答
地址：http://redrock.alien95.cn/know/answer.php
参数：

>questionId:  
>content:  
>token

返回：

```json
{
  "status": 200,
  "info": "success"
}
```
