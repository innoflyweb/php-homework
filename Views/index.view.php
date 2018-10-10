<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kodune Töö</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    <style>
        
    </style>
</head>
<body>
    <div class="container mx-auto font-sans">
        <div class="bg-blue text-center mt-6 py-2 rounded mb-8">
            <h1>Kodune töö</h1>
            
        </div>
        <div class="text-center">
            <span>
                <?php if (isset($status)) {
    echo $status;
} ?></span>
        </div>
        
        <form action="/" method="POST" class="flex flex-wrap">
            <div class="w-1/3 bg-transparent mx-2 py-2 px-1 my-1"><input type="text" name="email" value="" placeholder="Sisesta E-post"></div>
            <div class="w-1/3 bg-transparent mx-2 py-2 px-1 my-1"><input type="password" name="password" value="" placeholder="Sisesta parool"></div>
            <div class="w-1/4 bg-transparent mx-2 py-2 px-1 my-1 text-right">
                <button type="submit" name="type" value="add" class="bg-green-light hover:bg-green text-grey-darkest font-semibold py-2 px-4 border border-grey-light rounded shadow">Lisa</button>
            </div>
        </form>
        <div action="/" method="POST" class="flex flex-wrap">
            <div class="w-1/3 bg-transparent py-2 px-3 my-1 border-b">Email</div>
            <div class="w-1/3 bg-transparent py-2 px-3 my-1 border-b">Parool</div>
            <div class="w-1/4 bg-transparent py-2 px-3 my-1 border-b"></div>
        </div>
        <?php foreach ($users as $user) : ?>
        <form action="/" method="POST" class="flex flex-wrap">
            <div class="w-1/3 bg-transparent mx-2 py-2 px-1 my-1 rounded">
                <input type="text" name="email" value="<?=$user->email ?>">
                <input type="hidden" name="id" value="<?=$user->id ?>">
            </div>
            <div class="w-1/3 bg-transparent mx-2 py-2 px-1 my-1 rounded"><input type="password" name="password" value="<?=$user->password ?>"></div>
            <div class="w-1/4 bg-transparent mx-2 py-2 px-1 my-1 rounded text-right">
                <button type="submit" name="type" value="edit" class="bg-white hover:bg-grey-lightest text-grey-darkest font-semibold py-2 px-4 border border-grey-light rounded shadow">Muuda</button>
                <button type="submit" name="type" value="delete" class="bg-red hover:bg-red-light text-grey-darkest font-semibold py-2 px-4 border border-grey-light rounded shadow">Kustuta</button>
            </div>
        </form>
        <?php endforeach ?>
    </div>
</body>
</html>