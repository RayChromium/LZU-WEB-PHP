# WEB数据库期末大作业
#### 2017计算机一班蔡睿、2017计算机二班张心宇
##### 2019-2020秋季学期 WEB数据库技术 课程号：2043183 课序号：2043183
[![XAMPP](https://img.shields.io/badge/XAMPP-v7.3.12-brightgreen)](https://www.apachefriends.org/index.html)  [![Anti-996](https://img.shields.io/badge/LICENCE-ANTI--996-blue)](https://github.com/RayChromium/LZU-WEB-PHP/blob/master/LICENCE)
### 作业要求
- 用户功能模块
  - [x] 用户可以注册、登陆。用户可以添加修改自己的个人信息（性别、年龄、电话（必填）、QQ号、email），登陆界面允许用户保存用户名
  - [x] 用户浏览页面：用户登陆后可以查看推荐微博，未登录用户不可以浏览
  - [x] 用户可以浏览其他用户信息
  - [ ] 鼠标移到用户名称上能看到该用户的信息（用户名，简介，微博发布条数等）
  - [x] 微博浏览页面：点击用户能进入该用户微博页面，用户能看到该用户发布的所有微博
  - [x] 我的微博页面：用户能够看到自己发布的微博，能够对自己发布的微博进行修改
- 微博发布部分
  - [x] 发布微博
  - [x] 微博基本信息：发布内容、发布时间、发布地址
  - [x] 微博管理：浏览、添加、修改、删除微博
- 系统管理部分
  - [x] 用户管理：系统管理员能够浏览、删除用户
  - [x] 微博管理：系统管理员能够浏览、删除微博、设置推荐微博

### 安装

### 开发
#### 开发环境及工具
- `Windows 7`
- `Xampp v7.13.2`
- `Visual Studio Code` with Plugins：
  - [`GITLENS`](https://marketplace.visualstudio.com/items?itemName=eamodio.gitlens)
  - [`PHP Intelephense`](https://marketplace.visualstudio.com/items?itemName=bmewburn.vscode-intelephense-client)
  - [`Markdown All in One`](https://marketplace.visualstudio.com/items?itemName=yzhang.markdown-all-in-one)
  - [`Markdown Preview Github Styling`](https://marketplace.visualstudio.com/items?itemName=bierner.markdown-preview-github-styles)
  
#### 项目及功能描述

##### 亮点
1. **注册页面向手机发送SMS code**
2. 普通用户/管理员进行了对内容或用户的编辑操作后返回原页面
3. **通过获取登录用户的IP地址查询其真实地址（待完善）**

#### 迭代过程
详情见[*commit log*](https://github.com/RayChromium/LZU-WEB-PHP/commits/master)