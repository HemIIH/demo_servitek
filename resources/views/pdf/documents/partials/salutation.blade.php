<table>
    <tr>
        <td>
            <strong>An:</strong><br>
            {{ $employee->last_name . ',' .$employee->first_name }}<br>
            {{ $employee->street }}<br>
            {{ $employee->postal_code . ' ' . $employee->city }}
        </td>
        <td style="text-align: right; vertical-align: top;">
            {{ request('place') }}, den {{ request('date') }}
        </td>
    </tr>
</table>