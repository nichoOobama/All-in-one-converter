<!-- Side Navigation (Mapped from User Request) -->
<aside class="hidden lg:flex flex-col w-64 gap-stack-sm">
<div class="flex flex-col gap-1">
<a class="flex items-center gap-stack-sm p-stack-sm rounded-lg bg-primary-container text-on-primary-container" href="#">
<span class="material-symbols-outlined">person</span>
<span class="font-label-md text-label-md">Profile</span>
</a>
<hr class="my-stack-sm border-outline-variant"/>
<form action="{{route('logout')}}" method="post">
    @csrf
<button class="pt-2 flex items-center gap-stack-sm p-stack-sm rounded-lg text-error hover:bg-error-container transition-all" type="submit">
<span class="material-symbols-outlined">logout</span>
<span class="font-label-md text-label-md">Logout</span>
</button>
</form>
</div>
</aside>