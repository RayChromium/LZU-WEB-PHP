# WEB数据库期末大作业
#### 2017计算机一班蔡睿、2017计算机二班张心宇
##### 2019-2020秋季学期 WEB数据库技术 课程号：2043183 课序号：1
[![XAMPP](https://img.shields.io/badge/XAMPP-v7.3.12-brightgreen)](https://www.apachefriends.org/index.html)  [![Anti-996](https://img.shields.io/badge/LICENCE-ANTI--996-blue)](https://github.com/RayChromium/LZU-WEB-PHP/blob/master/LICENCE)
## 作业要求
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

## 安装
### 安装到自己的机器上进行测试的方法：
**由于本项目使用[![XAMPP](https://img.shields.io/badge/XAMPP-v7.3.12-brightgreen)](https://www.apachefriends.org/index.html)进行运行测试，建议安装`XAMPP`后使用。以下安装步骤默认用户已安装`XAMPP`与`Git`**
  
1. 进入`XAMPP`安装目录下的`htdocs`文件夹： `cd $(InstallDirectory)/xampp/htdocs`
2. 将本仓库内容`clone`到此目录下： `git clone https://github.com/RayChromium/LZU-WEB-PHP.git` 。(p.s. 如果没有安装`Git`，也可以点击右上方绿色的`clone or download`,选择下载`.zip`压缩包解压后放入`htdocs`)
3. 开启`XAMPP`，启用`Apache`与`MySQL`
4. 打开浏览器，在地址栏输入`localhost/LZU-WEB-PHP/src/login`即可使用
5. (可选)本仓库的目录结构如下：  
   > LZU-WEB-PHP  
 ├── LICENCE  
 ├── LICENCE_CN  
 ├── README.md  
 ├── import  
 │    └── mydb.sql  
 └── src  
     ├── addAdmin.php  
     ├── addRecommend.php  
     ├── adminShow.php  
     ├── adminUserManage.php  
     ├── conn.php  
     ├── del.php  
     ├── edit.php  
     ├── login.php  
     ├── recive.php  
     ├── removeAdmin.php  
     ├── removeRecommend.php  
     ├── show.php  
     ├── signup1.php  
     ├── userDel.php  
     └── welcome.php  
   2 directories, 19 files  
 
   如果需要导入仓库原有的数据，可以在`localhost/phpmyadmin`中创建数据库`mydb`并使用本仓库中的`/import/mydb.sql`
## 开发过程
### 开发环境及工具
- `Windows 7`
- `Xampp v7.13.2`
- `Visual Studio Code` with Plugins：
  - [`GITLENS`](https://marketplace.visualstudio.com/items?itemName=eamodio.gitlens)
  - [`PHP Intelephense`](https://marketplace.visualstudio.com/items?itemName=bmewburn.vscode-intelephense-client)
  - [`Markdown All in One`](https://marketplace.visualstudio.com/items?itemName=yzhang.markdown-all-in-one)
  - [`Markdown Preview Github Styling`](https://marketplace.visualstudio.com/items?itemName=bierner.markdown-preview-github-styles)
  

### 迭代过程
  

  
详情见[*commit log*](https://github.com/RayChromium/LZU-WEB-PHP/commits/Presentation)
  
## 项目及功能描述

### 使用指南



### 亮点
1. **注册页面向手机发送SMS code**
2. 普通用户/管理员进行了对内容或用户的编辑操作后返回原页面
3. **通过获取登录用户的IP地址查询其真实地址**

