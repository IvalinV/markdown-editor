<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Markdown Editor</title>
        <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css"/>
        <link rel="stylesheet" href="https://unpkg.com/@tailwindcss/typography@0.4.1/dist/typography.min.css"/>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>   
    </head>
    <body>
        <div class="grid grid-cols-2 gap-x-2 h-screen">
            <div class="border p-4">
                <textarea class="w-full h-full outline-none" name="markdown" id="markdown" cols="30" rows="10"></textarea>
            </div>

            <div class="border p-4">
                <div id="html" class="prose"></div>
            </div>
        </div>
    </body>
</html>

<script>
    function convert(){
        let data = document.querySelector('#markdown').value;
        axios.post('/', {markdown: data})
        .then(response => {
            document.querySelector('#html').innerHTML = response.data;
        });

        localStorage.setItem('markdown', data);
    }

    function init(){
        setInterval(() => {
            convert()
        }, 2000);

        document.querySelector('#markdown').value = localStorage.getItem('markdown')
    }

    init();
</script>