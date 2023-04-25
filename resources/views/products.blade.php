<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <ul>
        @foreach($products as $product)
            <li>
                <a href="{{ url('productos/'.$product->slug) }}">
                    <strong>{{ $product->title }}</strong>
                </a> -
                <a href="{{ url('productos/categoria/'.$product->category->slug) }}">
                    {{ $product->category->title }}
                </a>
            </li>
        @endforeach
    </ul>
</body>
</html>