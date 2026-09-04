<div class="dropdown patron-dir__row-menu">
    <button type="button"
            class="patron-dir__menu-btn"
            data-bs-toggle="dropdown"
            data-bs-boundary="viewport"
            aria-expanded="false"
            aria-label="Actions for {{ $student->firstname }} {{ $student->lastname }}">
        ⋮
    </button>
    <ul class="dropdown-menu dropdown-menu-end">
        <li>
            <a class="dropdown-item" href="{{ route('students.edit', $student->id) }}">Edit patron</a>
        </li>
        <li>
            <form action="{{ route('students.destroy', $student->id) }}" method="POST"
                  onsubmit="return confirm('Delete this student record?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="dropdown-item text-danger">Delete</button>
            </form>
        </li>
    </ul>
</div>
