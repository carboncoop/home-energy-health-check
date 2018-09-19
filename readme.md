# home-energy-health check

## Deployment

### Getting tooled up

To get ready to deploy onto Elastic Beanstalk:

1. Install [the AWS CLI tools](https://docs.aws.amazon.com/elasticbeanstalk/latest/dg/eb-cli3-install.html)
2. Run `eb init`
3. Choose the "EU (London)" region (eu-west-2)
4. Enter your AWS credentials
4. Say no to CodeCommit


### To deploy

* If your work is committed to git, run `eb deploy`.
* If your work is staged but not committed, run `eb deploy --staged`.


### Running commands on deploy

The `.ebextensions` directory holds a set of scripts that AWS runs on each deploy.

At the moment there is:
 * `10predeploy.config` which contains a command to re-build the database (`artisan migrate:refresh --seed --force`).  This should probably change to `artisan migrate --force` when the app has live data.

If other things need to be run pre-deploy then they can be added to that file.  `composer install` is run automatically by AWS already.

At the moment, `public/css/app.css` and `public/js/app.js` aren't built on the server, but whatever version you have locally is uploaded as part of the deploy.

There is some documentation here:

* https://docs.aws.amazon.com/elasticbeanstalk/latest/dg/customize-containers-ec2.html#customize-containers-format-packages
* http://blog.goforyt.com/laravel-5-aws-elastic-beanstalk-production-guide/
