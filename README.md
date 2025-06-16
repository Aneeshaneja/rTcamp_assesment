## Email a random XKCD challenge
This assignment is a part of rtCamp Campus placement drive at Chandigarh University. Though I have never worked in PHP but I'll apply my web dev skills to this project and see how it goes!

### `Statement`

Please create a simple PHP application that accepts a visitor’s email address and emails them random XKCD comics every five minutes.

* Your app should include email verification to avoid people using others’ email addresses.
* XKCD image should go as an email attachment as well as inline image content.
* You can visit https://c.xkcd.com/random/comic/ programmatically to return a random comic URL and then use JSON API for details https://xkcd.com/json.html
* Please make sure your emails contain an unsubscribe link so a user can stop getting emails.

Since this is a simple project it must be done in core PHP including API calls, recurring emails, including attachments should happen in core PHP. Please do not use any libraries.

### `Solution` 
Completed and [Hosted](https://rtcamphitik.000webhostapp.com/)

I've divided the challenge in 3 main sections :

- [x] Understanding XKCD while fetching random comic **(Done)**
- [x] Adding email functionality (verification)
- [x] Debugging :)

### `Resources`
I have used [stackoverflow](https://stackoverflow.com/) a lot! As mentioned above PHP is new to me so I referenced everything before doing. 
Other than this, [PHPmailer](https://github.com/PHPMailer/PHPMailer) is used to send mails(would have used mail() inbuilt fn but I encountered an issue with it while hosting the project online therefore used it.
