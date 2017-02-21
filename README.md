Pepper Web Services
===================

Setting API credentials
-----------------------

First, check out https://cloud.google.com/translate/docs/getting-started and donwload your credentials (as JSON).

Second, edit your web server configuration to add the `GOOGLE_APPLICATION_CREDENTIALS` environment variable.

For Apache this can be done like this

```
SetEnv GOOGLE_APPLICATION_CREDENTIALS «path to Google Cloud API credentials»
```
