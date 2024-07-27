@props([
    'line' => null,
])

@if ($line)
    <tr class="table__item">
        <td>{{ $line->line }}</td>
        <td>{{ $line->likes }}</td>
        <td>{{ $line->dislikes }}</td>

        <td>
            <button
                class="btn btn--icon--filled"
                wire:click="toggleLineStatus({{ $line->id }})"
            >
                @if ($line->active)
                    <span>disable</span>
                @else
                    <span>enable</span>
                @endif
            </button>
        </td>

        <td>
            <button
                class="btn btn--primary"
                wire:confirm="Wotsch dä werklech lösche?"
                wire:click="delete({{ $line->id }})"
            >
                <span>löschen</span>
            </button>
        </td>
    </tr>
@endif
