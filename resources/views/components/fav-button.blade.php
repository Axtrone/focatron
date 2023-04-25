@auth
    <div class="{{ isset($class) ? $class : '' }}">
        @if (!Auth::user()->teams->contains($team))
            <form action="{{ route('addfav', ['team' => $team]) }}" method="POST">
                @csrf
                <button type="submit">
                    <i class="fa-regular fa-heart"></i>
                </button>
            </form>
        @else
            <form action="{{ route('delfav', ['team' => $team]) }}" method="POST">
                @csrf
                <button type="submit">
                    <i class="fa-solid fa-heart text-red-600"></i>
                </button>
            </form>
        @endif
    </div>
@endauth
