<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Roles-Permissions') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Scripts -->
        
        <!-- ckeditor -->
        <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.css" />
        <style>
            .ck.ck-content:not(.ck-comment__input *) {
                height: 400px;
                overflow-y: auto;
                color: black;
                font-family: "Poppins", sans-serif;
            }
        </style>
        <!-- ckeditor -->
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
       
        <!-- Sweetalert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script type="text/javascript">
        $(".btn-delete").click(function(e){
            e.preventDefault();
            var form = $(this).parents('form');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed)
                {
                    swalWithBootstrapButtons.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                    });
                    form.submit();
                }
                else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire({
                        title: "Cancelled",
                        text: "Your imaginary file is safe :)",
                        icon: "info"
                    });
                }
            });
            });
    </script>
    <!-- Sweetalert -->

    <script src="https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.umd.js"></script>
    <script type="importmap">
        {
            "imports": {
                "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.js",
                "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.2.0/"
            }
        }
    </script>
    <script>
        const {
            ClassicEditor,
            Essentials,
            Bold,
            Italic,
            Font,
            Paragraph,
            Heading,
            Code,
            Link,
            CodeBlock,
            List
        } = CKEDITOR;

        ClassicEditor
            .create( document.querySelector( '#text' ), {
                plugins: [ Essentials, Bold, Italic, Font, Paragraph, Heading, Code, Link, CodeBlock, List],
                toolbar: ['undo', 'redo','|','heading','|','fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor',
                        '|',
                        'bold', 'italic', 'strikethrough', 'subscript', 'superscript', 'code',
                        '|',
                        'link', 'uploadImage', 'blockQuote', 'codeBlock',
                        '|',
                        'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent'
                    ],shouldNotGroupWhenFull: false
            });
    </script>

    </body>
</html>
