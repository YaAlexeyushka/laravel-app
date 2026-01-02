@extends('layouts.app')

@section('title', 'Данные')

@section('content')
<h1>Полученные данные</h1>

@if(count($data) > 0)
    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
            <tr style="background-color: #f4f4f4;">
                <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Имя</th>
                <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Email</th>
                <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Сообщение</th>
                <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Дата создания</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <td style="padding: 12px; border: 1px solid #ddd;">{{ $item['name'] }}</td>
                    <td style="padding: 12px; border: 1px solid #ddd;">{{ $item['email'] }}</td>
                    <td style="padding: 12px; border: 1px solid #ddd;">{{ $item['message'] }}</td>
                    <td style="padding: 12px; border: 1px solid #ddd;">{{ $item['created_at'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p style="margin-top: 20px;">Нет сохраненных данных.</p>
@endif
@endsection
