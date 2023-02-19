<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--tw-bg-opacity: 1;background-color:rgb(255 255 255 / var(--tw-bg-opacity))}.bg-gray-100{--tw-bg-opacity: 1;background-color:rgb(243 244 246 / var(--tw-bg-opacity))}.border-gray-200{--tw-border-opacity: 1;border-color:rgb(229 231 235 / var(--tw-border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{--tw-shadow: 0 1px 3px 0 rgb(0 0 0 / .1), 0 1px 2px -1px rgb(0 0 0 / .1);--tw-shadow-colored: 0 1px 3px 0 var(--tw-shadow-color), 0 1px 2px -1px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000),var(--tw-ring-shadow, 0 0 #0000),var(--tw-shadow)}.text-center{text-align:center}.text-gray-200{--tw-text-opacity: 1;color:rgb(229 231 235 / var(--tw-text-opacity))}.text-gray-300{--tw-text-opacity: 1;color:rgb(209 213 219 / var(--tw-text-opacity))}.text-gray-400{--tw-text-opacity: 1;color:rgb(156 163 175 / var(--tw-text-opacity))}.text-gray-500{--tw-text-opacity: 1;color:rgb(107 114 128 / var(--tw-text-opacity))}.text-gray-600{--tw-text-opacity: 1;color:rgb(75 85 99 / var(--tw-text-opacity))}.text-gray-700{--tw-text-opacity: 1;color:rgb(55 65 81 / var(--tw-text-opacity))}.text-gray-900{--tw-text-opacity: 1;color:rgb(17 24 39 / var(--tw-text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--tw-bg-opacity: 1;background-color:rgb(31 41 55 / var(--tw-bg-opacity))}.dark\:bg-gray-900{--tw-bg-opacity: 1;background-color:rgb(17 24 39 / var(--tw-bg-opacity))}.dark\:border-gray-700{--tw-border-opacity: 1;border-color:rgb(55 65 81 / var(--tw-border-opacity))}.dark\:text-white{--tw-text-opacity: 1;color:rgb(255 255 255 / var(--tw-text-opacity))}.dark\:text-gray-400{--tw-text-opacity: 1;color:rgb(156 163 175 / var(--tw-text-opacity))}.dark\:text-gray-500{--tw-text-opacity: 1;color:rgb(107 114 128 / var(--tw-text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 sm:items-center py-4 sm:pt-0">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="text-center">
                    <div class="mx-auto" style="width: 200px;">
                        <svg viewBox="0 0 1024 1024" version="1.1" style="fill: #17a2b8" xmlns="http://www.w3.org/2000/svg"><path d="M668.8 967.68c-8.96 0-17.28-6.4-18.56-15.36l-51.84-257.92c-1.92-9.6 3.2-18.56 12.8-21.76 120.32-41.6 200.96-154.24 200.96-280.96 0-163.84-133.76-297.6-298.88-297.6-164.48 0-298.88 133.12-298.88 297.6 0 126.72 80.64 239.36 200.96 280.96 8.96 3.2 14.72 12.8 12.8 21.76l-51.84 257.92c-1.92 10.24-12.16 17.28-22.4 14.72-10.24-1.92-17.28-12.16-14.72-22.4l48.64-241.92c-126.72-51.2-211.2-174.08-211.2-311.68C175.36 206.08 326.4 55.68 512.64 55.68c185.6 0 337.28 150.4 337.28 336 0 137.6-83.84 260.48-211.2 311.68l48.64 241.92c1.92 10.24-4.48 20.48-14.72 22.4C671.36 967.68 670.08 967.68 668.8 967.68zM133.76 968.32c-1.28 0-2.56 0-3.84-0.64-10.24-1.92-17.28-12.16-14.72-22.4l33.92-167.04C58.88 740.48 0 652.8 0 554.88c0-113.92 78.08-211.84 189.44-236.8 10.24-2.56 20.48 3.84 23.04 14.72 2.56 10.24-3.84 20.48-14.72 23.04C103.68 376.32 38.4 458.88 38.4 554.88c0 87.04 55.68 165.12 138.24 193.92 8.96 3.2 14.72 12.8 12.8 21.76l-37.12 183.04C151.04 961.92 142.72 968.32 133.76 968.32zM890.24 968.32c-8.96 0-17.28-6.4-18.56-15.36l-37.12-183.04c-1.92-9.6 3.2-18.56 12.8-21.76 82.56-28.8 138.24-106.24 138.24-193.92 0-96-65.28-177.92-159.36-199.68-10.24-2.56-16.64-12.8-14.72-23.04s12.8-16.64 23.04-14.72c111.36 25.6 189.44 122.88 189.44 236.8 0 97.92-58.88 186.24-148.48 224l33.92 167.04c1.92 10.24-4.48 20.48-14.72 22.4C892.8 968.32 891.52 968.32 890.24 968.32zM512.64 581.76c-96.64 0-175.36-78.08-175.36-174.72 0-10.88 8.32-19.2 19.2-19.2s19.2 8.32 19.2 19.2c0 74.88 61.44 136.32 136.96 136.32 75.52 0 136.96-60.8 136.96-136.32 0-10.88 8.32-19.2 19.2-19.2s19.2 8.32 19.2 19.2C688 503.68 609.28 581.76 512.64 581.76z"></path></svg>
                    </div>
                    <h1 style="font-size: 50px; color: #000; font-weight: bold;">COLLABORATE</h1>
                    <h5 style="font-size: 20px">A project management tool for developers</h5>
                </div>

                <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                        <a href="{{route('register')}}" style="background: #17a2b8; padding: 10px 25px; color: #FFF; border-radius: 8px">Register</a>

                        <a href="{{route('login')}}" style="background: #17a2b8; padding: 10px 25px; color: #FFF; border-radius: 8px">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
