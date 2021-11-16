<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReplies" aria-expanded="true" aria-controls="collapseReplies">
        <i class="fas fa-fw fa-cog"></i>
        <span>Replies</span>
    </a>
    <div id="collapseReplies" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Replies</h6>
            {{--            <a class="collapse-item" href="{{route('post.create')}}">Create Post</a>--}}
            <a class="collapse-item" href="{{route('reply.index')}}">View All Replies</a>
        </div>
    </div>
</li>
