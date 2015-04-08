@extends('layouts.admin')

@section('nav')
    @parent
    <nav><a href="{{url('student/create')}}">Ajouter un étudiant</a></nav>
@stop

@section('content')
    <div class="pagination">
        {!!$students->render()!!}
    </div>
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th>Status</th>
            <th>Voir</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>date</th>
            <th>delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach($students as $student)
            <tr class="{{($student->status=='publish')? 'success' : 'info'}}">
                <td>{{$student->status}}</td>
                <td><a href="{{url('student/'.$student->id)}}"><span
                                class="glyphicon glyphicon-eye-open"></span></a></td>
                <td><span class="glyphicon glyphicon-edit"></span> <a
                            href="{{url('student/'.$student->id.'/edit')}}">{{$student->firstname}}</a></td>
                <td>{{$student->name}}</td>
                <td>{{$student->published_at}} </td>
                <td>{!! Form::open(['url'=>'student/'.$student->id, 'method'=>'DELETE', 'class'=>'form-delete']) !!}
                    <div class="form-group">
                        {!! Form::submit('delete', ['class'=>'btn']) !!}
                    </div>
                {!! Form::close() !!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pagination">
        {!!$students->render()!!}
    </div>
@stop

@section('script')
    <script>
        $('.form-delete').submit(function () {
                return confirm("Confirm to delete post");
        });
    </script>
@stop

