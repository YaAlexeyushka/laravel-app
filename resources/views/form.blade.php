@extends('layouts.app')

@section('title', 'Форма')

@section('content')
<h1>Форма обратной связи</h1>

@if(session('success'))
    <div style="background-color: #d4edda; color: #155724; padding: 15px; margin-bottom: 20px; border-radius: 4px;">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div style="background-color: #f8d7da; color: #721c24; padding: 15px; margin-bottom: 20px; border-radius: 4px;">
        <ul style="list-style: none;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('form.submit') }}" method="POST" style="max-width: 600px;">
    @csrf
    
    <div style="margin-bottom: 15px;">
        <label for="name" style="display: block; margin-bottom: 5px;">Имя:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
    </div>
    
    <div style="margin-bottom: 15px;">
        <label for="email" style="display: block; margin-bottom: 5px;">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
    </div>
    
    <div style="margin-bottom: 15px;">
        <label for="message" style="display: block; margin-bottom: 5px;">Сообщение:</label>
        <textarea id="message" name="message" rows="5" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">{{ old('message') }}</textarea>
    </div>
    
    <button type="submit" style="background-color: #333; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">Отправить</button>
</form>
@endsection
