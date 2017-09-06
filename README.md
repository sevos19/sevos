<center>
# EFRONT PRO 4

## REST JSON API DOCUMENTATION
</center>
(Version 1.0)

_The key words &quot;MUST&quot;, &quot;MUST NOT&quot;, &quot;REQUIRED&quot;, &quot;SHALL&quot;, &quot;SHALL NOT&quot;, &quot;SHOULD&quot;, &quot;SHOULD NOT&quot;, &quot;RECOMMENDED&quot;, &quot;MAY&quot;, and &quot;OPTIONAL&quot; in this document are to be interpreted as described in__ _ [_RFC 2119_](http://www.ietf.org/rfc/rfc2119.txt) .
<center>
Documentation Index

| Quick Start | 4 |
| --- | --- |
| API Introduction | 5 |
| API Requirements | 6 |
| API Call Reference | 7 |
| API Error Handling | 10 |
| API Authentication | 11 |
| SDK Introduction | 11 |
| SDK Requirements | 11 |
| SDK Installation | 12 |
| SDK Examples | 13 |
</center>

Quick Start

    In this quick start we provide you with some very basic information about how to access the API. More information and examples can be found in the following chapters.

1. Access through the command line (cURL):

curl -u &lt;MY\_API\_KEY&gt;: [http://my-efront-pro.com/API/v1.0/System/Info](http://my-efront-pro.com/API/v1.0/System/Info)

- Replace &lt;MY\_API\_KEY&gt; with your API key.
- Keep the : symbol after your API key without a space before.
- Provide your domain and the API location. In the above example we use the API version 1.0 and request information about the system.



1. Access through the SDK:

$eFrontProSDK-&gt;GetAPI(&#39;System&#39;)-&gt;GetInfo();

- See more on how to initialize $eFrontProSDK, here.

**Note** : To use JSONP, append to the endpoint &quot;?callback=&lt;myCallbackName&gt;&quot; without the quotation marks.



API Introduction

    eFront PRO provides a comprehensive REST JSON API that allows interaction with remote services. Authentication is based on an API key that is defined under your installation&#39;s system settings. The functionality provided focuses on performing tasks meaningful for a remote service, such as user creation, course assignment, listing courses etc. In addition, one can use the API to provide basic SSO for users.

    To ease implementation of services, we provide a SDK library for PHP that automates the tasks of communicating with the API.

    The first part of this guide provides a detailed description of the available API calls, as well as information on authentication and error handling.

    The second part of the guide demonstrates the use of the PHP SDK, providing information on setting it up and performing some basic tasks.

You can find the latest version of this guide [here](https://github.com/epignosis/efrontPRO-SDK).

For comments and suggestions, visit [here](http://www.efrontlearning.net/contact).



The Efront PRO team.

API Requirements

    API doesn&#39;t have or require different technical requirements than eFront PRO. If your system meets the eFront PRO&#39;s requirements, then it also meets the requirements of the API.

    At this point, you may want to properly configure your web server to achieve 2 goals, if your web server is different than Apache. If your web server is Apache there already exists an .htaccess configuration file inside the www/API folder, but you have to enable the mod\_rewrite module (if not already enabled) on your own or inform your network/system administrator to do it for you.

1. The API recognizes only &quot;pretty - SEO friendly&quot; URLs, which means that you have to use a rewrite engine (for example Apache mod\_rewrite) and set the minimum required conditions and rules.

1. Make sure that if the PHP interacts with your web server through the Fast-CGI protocol, usually there exists a problem with the HTTP authorization headers, so you have to pass the HTTP authorization headers to an environment variable.

API Calls Reference

| **Entity** | **HTTP** | **Call** | **Purpose** |
| --- | --- | --- | --- |
| **Account** | POST | /Account/Status | Checks whether a user exists or not by providing the login name and the password. |
| **Branch** | GET | /Branches | Returns the branch list. |
| GET | /Branch/:Id | Returns information about the branch with the associated Id. |
| POST | /Branch | Creates a branch with the requested attributes. |
| **Branch**** + ****User** | PUT | /Branch/:Id/AddUser | Adds a user to the specified branch. The Id in the URL, refers to the branch. The Id of the user is defined as a PUT field, in the request. |
| **Category** | GET | /Categories | Returns the category list (tree structured). |
| GET | /Category/:Id | Returns information about the category with the associated Id. |
| **Course** | GET | /Courses | Returns the complete list of courses. |
| GET | /Course/:Id | Returns information about the course with the associated Id. |
| **Curriculum** | GET | /curriculums | Returns the complete list of curriculums. |
| **Course**** + ****User** | GET | /CourseUserStatus/:CourseId,:UserId | Returns information about the status of a specified user in the specified course. |
| POST | /CourseUserStatus/:CourseId,:UserId | Updates a user&#39;s information in the specified course. |
| PUT | /Course/:Id/AddUser | Adds a user to the specified course. The Id in the URL, refers to the course. The Id of the user is defined as a PUT field, in the request. |
| PUT | /Course/:Id/RemoveUser | Removes a user from the specified course. The Id in the URL, refers to the course. The Id of the user is defined as a PUT field, in the request. |
| **Curriculum**** + ****User** | PUT | /Curriculum/:Id/AddUser | Adds a user to the specified curriculum. The Id in the URL, refers to the curriculum. The Id of the user is defined as a PUT field, in the request. |
| PUT | /Curriculum/:Id/RemoveUser | Removes a user from the specified curriculum. The Id in the URL, refers to the curriculum. The Id of the user is defined as a PUT field, in the request. |
| **Group** | GET | /Groups | Returns the entire group list. |
| GET | /Group/:Id | Returns information about the group with the associated Id. |
| **Group**** + ****User** | PUT | /Group/:Id/AddUser | Adds a user to the specified group. The Id in the URL, refers to the group. The Id of the user is defined as a PUT field, in the request. |
| PUT | /Group/:Id/RemoveUser | Removes a user from the specified group. The Id in the URL, refers to the group. The Id of the user is defined as a PUT field, in the request. |
| **Plugin** | GET | /Plugins | Returns a list of the available plugins and their information. |
| GET | /Plugin/:pluginName | Same as the above, but for the requested plugin. |
| POST | /Plugin/:pluginName | Posts data to be used by the requested plugin. |

| **User** | GET | /Autologin/:loginName | Returns the auto-login URL for the requested user. |
| --- | --- | --- | --- |
| GET | /Logout/:loginName | Logouts the requested user. |
| POST | /User | Creates a new user given some registration information. The information are defined as POST data fields. The required information to create successfully a user are the &quot;login&quot;, &quot;name&quot;, &quot;surname&quot;, &quot;email&quot; and &quot;password&quot;. In the future we plan to add some more fields. |
| GET | /Users | Returns the entire user list. |
| GET | /Users/:eMail | Returns a list of users which they have the requested e-mail address. |
| GET | /User/:Id | Returns information about the user with the associated Id. |
| PUT | /User/:Id | Edits the specified user. |
| PUT | /User/:Id/Activate | Activates the specified user. |
| PUT | /User/:Id/Deactivate | Deactivates the specified user. |
| **System** | GET | /System/Info | Returns information about the system. |

API Error Handling

    The error state handling of the API is very easy. In each response a key &quot; **success**&quot; is always included. This key contains the value &quot; **true**&quot; in case of success or &quot; **false**&quot; when something has gone wrong. That way you can easily check if the call to the API was succeed or failed.

    Except that, we offer an additional methodology to be informed about the error states, and this is by the HTTP response status codes. Anything different than **200** , MUST be considered as an error state.

    When an error has been occurred you can find into the body of the response some other useful information such as its code, a generic message and optionally a more technical reason. For a live demonstration of the API calls and their responses (succeed and failed) you can use this tool.

| **HTTP Status Code** | **Reason** |
| --- | --- |
| **503** |
- Service unavailable. API status is disabled.
 |
| **405** |
- Unsupported HTTP method. Only GET, POST and PUT are currently supported.
 |
| **404** |
- The requested API call does not exist.
- The requested entity (User, Course, etc) which is specified for example by an Id, does not exist.
 |
| **401** |
- Authentication required.
 |
| **400** |
- General HTTP status code, if the action can&#39;t be processed.
 |

API Authentication

    eFront PRO API doesn&#39;t offer any call that it&#39;s public, in other words that it isn&#39;t require authentication. So you MUST authenticate your requests in order to use the API. But before this step, you have to enable its status and find out your personal private API key.

    To enable the API, just navigate to your &quot; **System Settings**&quot; through the eFront PRO administration control panel and proceed to the &quot; **API**&quot; tab. Check the &quot; **Enable API**&quot; checkbox and click on the &quot; **Save**&quot; button.

    Once you have enabled the API, copy your personal private API key to use it later on the SDK. In case that someone finds out this key, you can always generate a new one by clicking on the &quot; **refresh**&quot; icon.

    More information about how you MUST authenticate your requests (API calls) with your personal private key, you can read here.



SDK Introduction

    With the eFront PRO SDK, you will be able to use its API easily and efficiently without advanced programming knowledge.

Programming Language: **PHP** | Version: **2.0.0** |API Support: **1.0**



SDK Requirements

If your system meets the eFront PRO&#39;s requirements, then it also meets the requirements of the SDK.

SDK Installation

    In this chapter, we will analyze how to install your SDK. You MUST follow the below steps in order to work with the SDK:

1. Download the SDK (ZIP Archive).

1. Extract its contents anywhere you want inside your web server&#39;s document root.  The document root is the folder where the website files for a domain name are stored. You SHOULD contact your administrator in case that you aren&#39;t sure about this action. It&#39;s RECOMMENDED to extract the contents inside the **www** folder of your eFront PRO web application.

1. Create a php file inside the Source folder (the folder that the AutoLoader.php file is located).  There is no restriction about the name of this file, but it&#39;s RECOMMENDED to name it **index.php**.

1. Now paste the below code in the file you just create in order to start making calls:

**&lt;?php**

include &#39;AutoLoader.php&#39;;

use Epignosis\eFrontPro\Sdk\eFrontProSDK as eFrontProSDK;

use Epignosis\eFrontPro\Sdk\Factory\Handler\API as Api;

use Epignosis\eFrontPro\Sdk\Request\Handler\cURL as cUrl;

$apiVersion   = &#39;1.0&#39;;

$apiLocation  = &#39;my-domain.com/API&#39;;

$apiKey       = &#39;0123456789abcdef&#39;;

$eFrontProSDK = **new** eFrontProSDK( **new** Api(new cUrl));

$eFrontProSDK-&gt;Config($apiVersion, $apiLocation, $apiKey);

SDK Examples

    In the previous chapter you learn  how you can install the SDK. Moreover on step 4, you initialize the SDK with its dependencies, the version and of course your API key and its location.

    So far you did a lot, which means that your requests now will be automatically authenticated and you won&#39;t have to worry about URL construction for each unique call of the API. That&#39;s the responsibility of the SDK.

    In the below use cases, **each method of the GetAPI method** returns a string in JSON encoded format. You MUST decode it ( [json\_decode](http://php.net/manual/en/function.json-decode.php)), in order to access the properties of the response. SDK doesn&#39;t decode automatically these responses/strings, because sometimes it&#39;s useful to store immediately this string into a database or create an array of multiple JSON encoded strings and do another work with it.

    Finally it&#39;s always RECOMMENDED as a good practice, to use the SDK inside a try/catch block. For example:

try {

    // various SDK commands ..

} catch (\Exception $e) {

    echo &#39;Oops! An error occurred. [&#39;, $e-&gt;getMessage(), &#39;, &#39;, $e-&gt;getCode(), &#39;]&#39;;

}

**BASIC EXAMPLES**

**Check the status of an account.**

$eFrontProSDK-&gt;GetAPI(&#39;Account&#39;)-&gt;Exists($loginName, $password);

**Get all the branches****.**

$eFrontProSDK-&gt;GetAPI(&#39;BranchList&#39;)-&gt;GetAll();

**Get information about a branch****.** GetInfo method, accepts a positive integer as the branch Id.

$eFrontProSDK-&gt;GetAPI(&#39;Branch&#39;)-&gt;GetInfo($branchId);

**Create a branch****.** Create method, accepts an associative array as the branch information to be created. The required information consisted of the &quot;name&quot; and &quot;url&quot;; &quot;parent\_ID&quot; and &quot;public\_ID&quot; are optional.

$eFrontProSDK-&gt;GetAPI(&#39;Branch&#39;)-&gt;Create([

        &#39;name&#39; =&gt; &#39;foo&#39;, &#39;url&#39; =&gt; &#39;foo&#39;, &#39;parent\_ID&#39; =&gt; 10, &#39;public\_ID&#39; =&gt; &#39;abc123&#39;

]);

**Add a user in a branch****.** AddRelation method, accepts 2 parameters which both are positive integers. The 1st one refers to the user&#39;s Id and the 2nd to the branch&#39;s Id.

$eFrontProSDK-&gt;GetAPI(&#39;BranchUser&#39;)-&gt;AddRelation($userId, $branchId);

**Get all the categories (tree structured)****.**

$eFrontProSDK-&gt;GetAPI(&#39;CategoryList&#39;)-&gt;GetAll();

**Get information about a category****.** GetInfo method, accepts a positive integer as the category Id.

$eFrontProSDK-&gt;GetAPI(&#39;Category&#39;)-&gt;GetInfo($categoryId);

**Get all courses****.**

$eFrontProSDK-&gt;GetAPI(&#39;CourseList&#39;)-&gt;GetAll();

**Get information about a course****.** GetInfo method, accepts a positive integer as the course Id.

$eFrontProSDK-&gt;GetAPI(&#39;Course&#39;)-&gt;GetInfo($courseId);

**Get all courses****.**

$eFrontProSDK-&gt;GetAPI(&#39;CurriculumList&#39;)-&gt;GetAll();

**Get all the groups****.**

$eFrontProSDK-&gt;GetAPI(&#39;GroupList&#39;)-&gt;GetAll();

**Get information about a group****.** GetInfo method, accepts a positive integer as the group Id.

$eFrontProSDK-&gt;GetAPI(&#39;Group&#39;)-&gt;GetInfo($groupId);

**Get all the plugins****.**

$eFrontProSDK-&gt;GetAPI(&#39;Plugin&#39;)-&gt;GetAll();

**Get information about a plugin****.** GetInfo method, accepts a string as the plugin name.

$eFrontProSDK-&gt;GetAPI(&#39;Plugin&#39;)-&gt;GetInfo($pluginName);

**Notify the specified plugin by sending some data****.** Notify method, accepts a string as the plugin name (1st parameter) and an array (2nd parameter) with the custom notification data.

$eFrontProSDK-&gt;GetAPI(&#39;Plugin&#39;)-&gt;Notify($pluginName, $data);

**Get all the users****.**

$eFrontProSDK-&gt;GetAPI(&#39;UserList&#39;)-&gt;GetAll();

**Get all the users by their e-mail address****.** GetAllByMail method, accepts a string as the e-mail address of a user.

$eFrontProSDK-&gt;GetAPI(&#39;UserList&#39;)-&gt;GetAllByMail($mailAddress);

**Get information about a user****.** GetInfo method, accepts a positive integer as the user Id.

$eFrontProSDK-&gt;GetAPI(&#39;User&#39;)-&gt;GetInfo($userId);

**Activate a user****.** Activate method, accepts a positive integer as the user Id.

$eFrontProSDK-&gt;GetAPI(&#39;User&#39;)-&gt;Activate($userId);

**Deactivate a user****.** Deactivate method, accepts a positive integer as the user Id.

$eFrontProSDK-&gt;GetAPI(&#39;User&#39;)-&gt;Deactivate($userId);

**Create a user****.** Create method, accepts an associative array as the user&#39;s information to be created. The required information consisted of the login, name, surname, email and password fields.

$eFrontProSDK-&gt;GetAPI(&#39;User&#39;)-&gt;Create ([

    &#39;login&#39; =&gt; &#39;foo&#39;, &#39;name&#39; =&gt; &#39;bar&#39;, &#39;surname&#39; =&gt; &#39;baz&#39;,

    &#39;email&#39; =&gt; &#39;foo@bar.buz&#39;, &#39;password&#39; =&gt; &#39;blackWhale&#39;

]);

**Edit a user****.** Edit method, accepts 2 parameters. The 1st parameter is a positive integer as the user Id and the 2nd an associative array as the user&#39;s information to be edited. The keys of the array are the same as the above method (Create) but aren&#39;t required all of them, so you can edit only the information which you want.

$eFrontProSDK-&gt;GetAPI(&#39;User&#39;)-&gt;Edit (

    $userId, [&#39;login&#39; =&gt; &#39;foo1&#39;, &#39;password&#39; =&gt; &#39;blackWhale123&#39;]

);

**Add a user in a group****.** AddRelation method, accepts 2 parameters which both are positive integers. The 1st one refers to the user&#39;s Id and the 2nd to the group&#39;s Id.

$eFrontProSDK-&gt;GetAPI(&#39;UserGroup&#39;)-&gt;AddRelation($userId, $groupId);

**Remove a user from a group****.** RemoveRelation method, accepts 2 parameters which both are positive integers. The 1st one refers to the user&#39;s Id and the 2nd to the group&#39;s Id.

$eFrontProSDK-&gt;GetAPI(&#39;UserGroup&#39;)-&gt;RemoveRelation($userId, $groupId);

**Add a user in a course****.** AddRelation method, accepts 3 parameters which. The 1st one refers to the user&#39;s Id (positive integer), the 2nd to the course&#39;s Id (positive integer) and 3rd to whether you want to force the operation or not, if the requested course belongs to a curriculum. The last parameter is set to false by default.

$eFrontProSDK-&gt;GetAPI(&#39;CourseUser&#39;)-&gt;AddRelation($userId, $courseId, $force);

**Add a user in a curriculum****.** AddRelation method, accepts 3 parameters which. The 1st one refers to the user&#39;s Id (positive integer), the 2nd to the curriculum&#39;s Id (positive integer) and 3rd to whether you want to force the operation or not. The last parameter is set to false by default.

$eFrontProSDK-&gt;GetAPI(&#39;CurriculumUser&#39;)-&gt;AddRelation($userId, $curriculumId, $force);

**Check the status of a user in a course****.** CheckStatus method, accepts 2 parameters which both are positive integers. The 1st one refers to the user&#39;s Id and the 2nd to the course&#39;s Id.

$eFrontProSDK-&gt;GetAPI(&#39;CourseUser&#39;)-&gt;CheckStatus($userId, $courseId);

**Update the status of a user in a course****.** UpdateStatus method, accepts 3 parameters. The first 2 are positive integers. The 1st one refers to the user&#39;s Id and the 2nd to the course&#39;s Id. The last is an array which contains the update info.

$eFrontProSDK-&gt;GetAPI(&#39;CourseUser&#39;)-&gt;UpdateStatus (

$userId, $courseId,

[&#39;score&#39; =&gt; 100, &#39;to\_timestamp&#39; =&gt; 1418893082, &#39;status&#39; =&gt; &#39;completed&#39;]

);

**Remove a user from a course**. RemoveRelation method, accepts 2 parameters which both are positive integers. The 1st one refers to the user&#39;s Id and the 2nd to the course&#39;s Id.

$eFrontProSDK-&gt;GetAPI(&#39;CourseUser&#39;)-&gt;RemoveRelation($userId, $courseId);

**Remove a user from a curriculum**. RemoveRelation method, accepts 2 parameters which both are positive integers. The 1st one refers to the user&#39;s Id and the 2nd to the curriculum&#39;s Id.

$eFrontProSDK-&gt;GetAPI(&#39;CurriculumUser&#39;)-&gt;RemoveRelation($userId, $curriculumId);

**Get information about the system**.

$eFrontProSDK-&gt;GetAPI(&#39;System&#39;)-&gt;GetInfo();

**Autologin a user****.**Autologin method, accepts a string as the user&#39;s login name.

$eFrontProSDK-&gt;GetAPI(&#39;User&#39;)-&gt;AutoLogin($loginName);

**Logout a user****.**Logout method, accepts a string as the user&#39;s login name.

$eFrontProSDK-&gt;GetAPI(&#39;User&#39;)-&gt;Logout($loginName);

**ADVANCED EXAMPLES**

**Logout all the users:**

**try** {

    _// See page 12 .._

    _// Fetch all the users:_

    $userList = json\_decode (

        $eFrontProSDK-&gt;GetAPI( **&#39;UserList&#39;** )-&gt;GetAll(), **true**

**   ** );

**   ** _// Check if the call was succeed:_

**    if** (!$userList[**&#39;success&#39;**]) {
         **throw new** \Exception (

            $userList[**&#39;error&#39;**][**&#39;message&#39;**], $userList[**&#39;error&#39;**][**&#39;code&#39;**]
        );
    }

_    // Iterate through the user list:_
 **   foreach** ($userList[**&#39;data&#39;**] **as** $user) {
        $logoutResponse = json\_decode (

            $eFrontProSDK-&gt;GetAPI( **&#39;User&#39;** )-&gt;Logout($user[**&#39;login&#39;**]),

            **true**

**       ** );

         **echo**  **&#39;User &lt;b&gt;&#39;** , $user[**&#39;login&#39;**], **&#39;&lt;/b&gt; was &#39;** ;

_        // Check whether the logout process was succeed or not:_
         **if** ($logoutResponse[**&#39;success&#39;**]) {
             **echo**  **&#39;logout with success.&lt;br&gt;&#39;** ;
        } **else** {
             **echo**  **&#39;not possible to logout.&lt;br&gt;&#39;** ;
        }
    }
} **catch** (\Exception $e) {
     **echo** $e-&gt;getMessage();
}

**Activate all the users with odd Id and deactivate these with even Id:**

**try** {

_    // See page 12 .._

    _// Fetch all the users:_

    $userList = json\_decode (

        $eFrontProSDK-&gt;GetAPI( **&#39;UserList&#39;** )-&gt;GetAll(), **true**

**   ** );

**   ** _// Check if the call was succeed:_

**    if** (!$userList[**&#39;success&#39;**]) {
         **throw new** \Exception (

            $userList[**&#39;error&#39;**][**&#39;message&#39;**], $userList[**&#39;error&#39;**][**&#39;code&#39;**]
        );
    }

_    // Iterate through the user list:_
 **   foreach** ($userList[**&#39;data&#39;**] **as** $user) {
        $apiUser    = $eFrontProSDK-&gt;GetAPI( **&#39;User&#39;** );

        $evenNumber = $user[**&#39;id&#39;**] % 2 == 0;

        $response =

            ($evenNumber)

                ? json\_decode (
                      $eFrontProSDK-&gt;GetAPI( **&#39;User&#39;** )-&gt;Deactivate($user[**&#39;id&#39;**]),
                      **true
                  ** )
                : json\_decode (
                      $eFrontProSDK-&gt;GetAPI( **&#39;User&#39;** )-&gt;Activate($user[**&#39;id&#39;**]),
                      **true
                  ** );

        **echo**  **&#39;User &lt;b&gt;&#39;** , $user[**&#39;login&#39;**], **&#39;&lt;/b&gt; was &#39;** ;

**       if** ($response[**&#39;success&#39;**]) {
             **echo** $evenNumber ? **&#39;deactivated&#39;** : **&#39;activated&#39;** , **&#39; with success.&lt;br&gt;&#39;** ;

        } **else** {
             **echo**  **&#39;not possible to &#39;** , $evenNumber ? **&#39;deactivated&#39;** : **&#39;activated&#39;** , **&#39;&lt;br&gt;&#39;** ;

        }

    }
} **catch** (\Exception $e) {
     **echo** $e-&gt;getMessage();
}

**Create a user (assuming a male), assign him to a course and get the login URL by auto login him:**

**try** {

    _// See page 12 .._

    _// Create the user:_
    $userInfo = [
         **&#39;login&#39;    ** =&gt; **&#39;efront&#39;** ,
         **&#39;name&#39;    ** =&gt; **&#39;efront&#39;** ,
         **&#39;surname&#39;  ** =&gt; **&#39;efront&#39;** ,
         **&#39;email&#39;    ** =&gt; **&#39;xarhsdev@efrontlearning.net&#39;** ,
         **&#39;password&#39;** =&gt; **&#39;foobarbuz&#39;**
    ];

    $userCreation = json\_decode (
        $eFrontProSDK-&gt;GetAPI( **&#39;User&#39;** )-&gt;Create($userInfo), **true**
    );

 _   // Throw an exception if the creation was failed:_
 **   if** (!$userCreation[**&#39;success&#39;**]) {
         **throw new** \Exception (
            $userCreation[**&#39;error&#39;**][**&#39;message&#39;**], $userCreation[**&#39;error&#39;**][**&#39;code&#39;**]
        );
    }

 _   // Get the course list:_
    $courseList = json\_decode (
        $eFrontProSDK-&gt;GetAPI( **&#39;CourseList&#39;** )-&gt;GetAll(), **true**
    );

 _   // Throw an exception if the call was failed:_
 **   if** (!$courseList[**&#39;success&#39;**]) {
         **throw new** \Exception (
            $courseList[**&#39;error&#39;**][**&#39;message&#39;**], $courseList[**&#39;error&#39;**][**&#39;code&#39;**]
        );
    }

 _   // Assign our user to the 1st course of the course list:_
    $course = _reset_($courseList[**&#39;data&#39;**]);

    $courseAssignResult = json\_decode (
        $eFrontProSDK-&gt;GetAPI( **&#39;CourseUser&#39;** )-&gt;AddRelation (
            _// The Create method was returned his Id:
            _ $userCreation[**&#39;data&#39;**][**&#39;id&#39;**], $course[**&#39;id&#39;**]
        ),
         **true**
    );

_    // Throw an exception if the call was failed:_
 **   if** (!$courseAssignResult[**&#39;success&#39;**]) {
         **throw new** \Exception (
            $courseAssignResult[**&#39;error&#39;**][**&#39;message&#39;**],

            $courseAssignResult[**&#39;error&#39;**][**&#39;code&#39;**]
        );
    }

 _   // Fetch the auto-login URL:_
    $autoLoginResult = json\_decode (
        $eFrontProSDK-&gt;GetAPI( **&#39;User&#39;** )-&gt;Autologin($userInfo[**&#39;login&#39;**]), **true**
    );

 _   // Throw an exception if the call was failed:_
 **   if** (!$autoLoginResult[**&#39;success&#39;**]) {
         **throw new** \Exception (
            $autoLoginResult[**&#39;error&#39;**][**&#39;message&#39;**], $autoLoginResult[**&#39;error&#39;**][**&#39;code&#39;**]
        );
    }

    $autoLoginURL = $autoLoginResult[**&#39;data&#39;**];

 _   // .._

} **catch** (\Exception $e) {
     **echo** $e-&gt;getMessage();
}

**For each registered user, print information about courses:**

**&lt;?php

try**
  {
    _// See page 12 .._

   _// Fetch the user list:
    _ $userList = json\_decode(
        $eFrontProSDK-&gt;GetAPI( **&#39;UserList&#39;** )-&gt;GetAll(), **true
    ** );

     **if** (!$userList[**&#39;success&#39;**]) {
         **throw new** \RuntimeException (
            $userList[**&#39;error&#39;**][**&#39;message&#39;**],
            $userList[**&#39;error&#39;**][**&#39;code&#39;**]
        );
    }

    **echo
         ****&#39;&lt;table border=3 cellpadding=10&gt;&lt;tbody&gt;&lt;tr&gt;&#39;**,
         **&#39;&lt;th&gt;Id&lt;/th&gt;&#39;** ,
         **&#39;&lt;th&gt;Login&lt;/th&gt;&#39;** ,
         **&#39;&lt;th&gt;Name&lt;/th&gt;&#39;** ,
         **&#39;&lt;th&gt;Surname&lt;/th&gt;&#39;** ,
         **&#39;&lt;th&gt;e-Mail&lt;/th&gt;&#39;** ,
        **&#39;&lt;th&gt;Courses [Name, Status]&lt;/th&gt;&#39;**,
         **&#39;&lt;th&gt;Avg. Score&lt;/th&gt;&lt;/tr&gt;&#39;** ;

     **foreach** ($userList[**&#39;data&#39;**] **as** $user) {
        _// For the current user fetch the courses that he/she is
        // registered to:
        _ $userInfo = json\_decode (
            $eFrontProSDK-&gt;GetAPI( **&#39;User&#39;** )-&gt;GetInfo($user[**&#39;id&#39;**]), **true
        ** );

         **if** (!$userInfo[**&#39;success&#39;**]) {
             **throw new** \RuntimeException (
                $userInfo[**&#39;error&#39;**][**&#39;message&#39;**],
                $userInfo[**&#39;error&#39;**][**&#39;code&#39;**]
            );
        }

        **echo
             ****&#39;&lt;tr&gt;&lt;td&gt;&#39;**, $user[**&#39;id&#39;**],**&#39;&lt;/td&gt;&#39;**,
             **&#39;&lt;td&gt;&#39;** , $user[**&#39;login&#39;**], **&#39;&lt;/td&gt;&#39;** ,
             **&#39;&lt;td&gt;&#39;** , $user[**&#39;name&#39;**], **&#39;&lt;/td&gt;&#39;** ,
             **&#39;&lt;td&gt;&#39;** , $user[**&#39;surname&#39;**], **&#39;&lt;/td&gt;&#39;** ,
             **&#39;&lt;td&gt;&#39;** , $user[**&#39;email&#39;**], **&#39;&lt;/td&gt;&lt;td&gt;&#39;** ;

        $courseList = $userInfo[**&#39;data&#39;**][**&#39;courses&#39;**][**&#39;list&#39;**];

         **if** ( **empty** ($courseList)) {
            $avgScore = **&#39;-&#39;** ;

             **echo**  **&#39;-&#39;** ;
        } **else** {
            $avgScore = 0.0;
            $c = 0;

             **foreach** ($courseList **as** $info) {
                $avgScore += $info[**&#39;score&#39;**];
                $c++;

                **echo
                    ** _sprintf_ (
                        **&#39;[%s, %s]&lt;br&gt;&#39;**,
                        $info[**&#39;formatted\_name&#39;**],
                        $info[**&#39;status&#39;**]
                    );
            }

             **if** ($c &gt; 0) {
                $avgScore /= $c;
                $avgScore = _round_($avgScore, 2);
            }
        }

         **echo**  **&#39;&lt;/td&gt;&lt;td&gt;&#39;**. $avgScore . **&#39;&lt;/td&gt;&lt;/tr&gt;&#39;** ;
    }

     **echo**  **&#39;&lt;/tbody&gt;&lt;/table&gt;&#39;** ;
} **catch** (\Exception $e) {
     **echo** $e-&gt;getMessage();
}