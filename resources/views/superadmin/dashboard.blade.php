<div>
    Welcome Super Admin Page
</div>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
        Logout
    </button>
</form>

