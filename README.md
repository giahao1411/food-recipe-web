# Sweet Tooth Recipe

Welcome to Sweet Tooth Recipe, a website where you can explore a wide range of delicious recipes or share your own culinary creations with the world. Whether you're a seasoned chef or a novice in the kitchen, Sweet Tooth Recipe is here to satisfy your cravings and inspire your next cooking adventure.

## Installation

To get started, follow these simple steps:

1. Clone the project from [GitHub](https://github.com/giahao1411/food-recipe-web):

```bash
git clone https://github.com/giahao1411/food-recipe-web.git
```

2. Set up your local development environment using XAMPP or any other suitable server environment.

3. Open the project directory in your preferred code editor and start exploring or customizing the code to fit your needs.

## Usage

Sweet Tooth Recipe allows users to:

-   Search for recipes based on keywords, ingredients, or categories.
-   Upload their own recipes to share with the community.
-   Sign up for an account to unlock additional features such as recipe management and personalized profiles.
-   Contribute to the project by submitting pull requests or reporting issues.

## Roadmap

Here are some planned features and improvements for Sweet Tooth Recipe:

-   [x] Fix offsive directory path in signUpAuthentication.php
-   [ ] URL bar changing handling in profile.php
-   [x] Change this script "Email(or username) or password is incorrect!" on redirectToErrorPage in loginAuthentication.php
-   [x] Block words (anti spam, posting function will enable only after 3 days, if has words not allowed, block that account after 5 time) (almost done)
    -   [Vietnamese blocklist](https://github.com/blue-eyes-vn/vietnamese-offensive-words)
    -   [Vietnamese blocklist 2](https://github.com/Eris-182/vn-badwords)
    -   [English blocklist](https://github.com/zacanger/profane-words/)
-   [x] Sign up using username (not recommend)
-   [x] Function add, delete recipe for log in user
-   [x] Improve offensive words filter
-   [x] Edit user information
-   [x] Design database for add recipes
-   [ ] Import database automatically (Both using the same database - for n collaborator)
-   [x] Optimize performance and scalability.
-   [ ] Rewrite readme.
-   [x] Hover user icon.
-   [x] Deny access after log out to all "logged in" site.
-   [ ] Random recipe [API](www.themealdb.com/api/json/v1/1/random.php)
-   [x] Initiate database (done)
-   [x] Design database for log in (username, password) (done)
-   [x] Log in (done)
-   [x] Log in authentication (done)
-   [x] User authorization when passed log in (done)
-   [x] Responsive website (done)
-   [x] Password encryption (done)
-   [x] Sign up check unique email (done)
-   [x] Sign up check unique email and username (done)
-   [x] Sign up and Sign in error catching on site not jump to another page (done)
-   [x] User profile template (done)
-   [x] Add privacy policy [Privacy Policy](https://www.termsfeed.com/live/fff0edc1-63bd-415e-999b-475e909da246) (done)
-   [x] Add license [GNU GENERAL PUBLIC LICENSE](LICENSE.html) (Done)
-   [x] Display user profile as to current log in user (done)

## Contributing

We welcome contributions from the community. If you have ideas for new features, bug fixes, or other improvements, please open an issue or submit a pull request. Let's make Sweet Tooth Recipe even better together!

## License

Sweet Tooth Recipe is licensed under the [GNU General Public License (GPLv3)](LICENSE), which means you are free to use, modify, and distribute the code as long as you adhere to the terms of the license.

Happy cooking!
