# AWS - PHP 8.1 Custom Runtime for Lambda Functions

## Steps
1. Create a clean composer project without a src folder
2. Require Bref/Bref Package, check https://packagist.org/packages/bref/bref and https://bref.sh/ 
> composer require bref/bref
3. Create an index.php file as handler for lambda function, eg: Index.php content
```
use Bref\Context\Context;

require __DIR__.'/vendor/autoload.php';

return function($event, Context $context){
  echo json_encode(["info"=>"This is going to cloudwatch"]);
  return json_encode(["message"=>sprintf('Hello, %s!',$event['name'] ?? "uknown")]);
}

```
4. Create a file zip with all current files, zip file has to contains vendor,composer.json and composer.lock and of course index.php
5. You can use aws cli to create your lambda function with the command, to install and setup aws cli check https://docs.aws.amazon.com/cli/latest/userguide/getting-started-install.html and https://docs.aws.amazon.com/cli/latest/userguide/getting-started-quickstart.html (simple way to set credentials short-term-credentials):
```
aws lambda create-function --function-name test_func_php --role arn:aws:iam::754439770965:role/crud-user-dev-us-east-1-lambdaRole --handler index.php --runtime provided.al2 --memory-size 256 --layers "arn:aws:lambda:us-east-1:53-81:76" --zip-file fileb://index.zip;892f069c-6f8f-4ab6-9b3f-9380ac6533b2-81:76" --zip-file fileb://index.zip;892f069c-6f8f-4ab6-9b3f-9380ac6533b2
```
* Note: --role arn::aws:iam... is a basic role, each lambda function needs an iam role, check: https://docs.aws.amazon.com/lambda/latest/dg/lambda-intro-execution-role.html
* Note: --layers "arn::aws::..." is the layer arn for php 8.1, check https://runtimes.bref.sh/

