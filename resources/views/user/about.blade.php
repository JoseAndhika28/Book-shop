@extends('layout.navbar')

@section('container')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Document</title>
</head>
<body>
         <!-- About Me -->
 <section class="flex items-center justify-center text-center">
    <div class="w-full max-w-4xl grid grid-cols-2 gap-5 p-6">
      <div class="p-4 text-black">
        <h1 class="text-4xl font-bold text-left mb-2">About us</h1>
        <p class="text-justify">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias, suscipit. Incidunt natus impedit quam architecto vel corporis consequuntur odit magnam, vitae cumque quisquam optio dolorum minus, fuga blanditiis sunt similique. Nihil neque aliquid, temporibus optio dolores delectus fugit voluptas impedit esse inventore nesciunt omnis quis sit modi doloribus facilis vitae.
        </p><br>
        <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae unde praesentium mollitia vitae inventore, distinctio deleniti blanditiis delectus quam rem.</p>
      </div>
      <div class="flex justify-center items-center rounded-2xl transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110">
        <img src="resource/Profile Jose Andhika Putra.jpg" alt="Example Image" class="max-w-full h-auto rounded-2xl" /> 
      </div>
    </div>
  </section>
</body>
</html>

@endsection