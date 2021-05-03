import dj_database_url

DATABASES['default'] = dj_database_url.config(
    default='mysql://root:<26021711>@localhost:3306/<mathmode>',
)