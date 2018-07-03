
@extends('layers.layer')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 center-block text-center mt-5">
                <h3>Список материалов</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table mt-5">
                    <thead class="thead-dark">
                    <th>title</th>
                    <th>Description</th>
                    <th>View</th>
                    </thead>
                    <tbody>
                    @foreach ($materials as $material)
                    <tr>
                        <td>{{ $material->title }}</td>
                        <td>{{ $material->description }}</td>
                        <td><a href="views/{{ $material->id }}" class="btn btn-success">Просмотр</a></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection