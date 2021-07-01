## TASKS
- [X] Show initially the most parent category then add toggle to show children (If parent
category was clicked then next 1st child element/s should show or hide) – (Collapse or
hide the next category layer)
- [X] On each category that has child, add functionality that if user checked the checkbox, it
will show all subtree items & categories until it reaches the last item/s (Collapse all), Else
hide all.
- [X] Laravel for Backend. Use secured api endpoints to retrieve data based on category, brand and variant
- [X] JQuery for Frontend

## SCREENSHOTS
![initial](https://user-images.githubusercontent.com/72032410/124047687-4f209280-da47-11eb-8c99-15f479cef511.PNG)
![Capture](https://user-images.githubusercontent.com/72032410/124047469-d9b4c200-da46-11eb-9e9f-17bf52e12fa2.PNG)
![Capture PNG1](https://user-images.githubusercontent.com/72032410/124047598-24363e80-da47-11eb-9a0e-7a61fe8fde81.PNG)

## TEST ACCOUNT
- email: testuser@example.com
- password testuser

## URL
```
http://127.0.0.1:8000/
```

## Setup
``` 
git clone https://github.com/rquimora/c3_interactive_manila.git
composer install
php artisan migrate
php artisan passport:install
php artisan db:seed
php artisan serve
```
