

<aside class="col-md-4 blog-sidebar">


    <div class="p-4">
        <h4 class="font-italic">Archives</h4>
        <ol class="list-unstyled mb-0">
            @for($i=0; $i<6; $i++)
            <li><a href="{{ route('posts',date('Y-m',strtotime(-$i.'month'))) }}">{{ date('F Y',strtotime(-$i.'month')) }}</a></li>
            @endfor
        </ol>
    </div>

</aside><!-- /.blog-sidebar -->
