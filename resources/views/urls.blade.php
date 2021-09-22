<table class="table table-bordered urltbl">
        <thead>
            <tr>
                <th>SLUG</th>
                <th>URL</th>
                <th>CREATED AT</th>                
            </tr>
        </thead>
        <tbody>
            @if(!empty($urls) && $urls->count())
                @foreach($urls as $key => $value)
                    <tr>
                        <td><a target="_blank" href="{{ $value->full_shortened_url }}">{{ $value->full_shortened_url }}</a></td>
                        <td>{{ $value->destination }}</td>
                        <td>{{ date('d/m/Y, h:i A', strtotime($value->created_at)) }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="10">No data found.</td>
                </tr>
            @endif
        </tbody>
    </table>
  <div class="d-flex justify-content-center">   
    {!! $urls->links() !!}
</div>

     
