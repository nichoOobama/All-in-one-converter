<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All-in-One Converter</title>
</head>
<body>
    <h1>All-in-One File Converter</h1>

    @if ($errors->any())
        <div style="border: 1px solid red; padding: 10px; margin-bottom 20px;">
            <strong>Errors:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div style="border: 1px solid green; padding: 10px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <h2>Upload & Convert</h2>
    <form action="{{ route('convert.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="file">Select File:</label><br>
            <input type="file" name="file" id="file" required>
        </div>

        <div>
            <label for="target_format">Convert To:</label><br>
            <select name="target_format" id="target_format" required>
                <option value="">-- Select Format --</option>

                <optgroup label="Images">
                    @foreach ($formats['image'] ?? [] as $fmt)
                        <option value="{{ $fmt }}">{{ strtoupper($fmt) }}</option>
                    @endforeach
                </optgroup>

                <optgroup label="Video">
                    @foreach ($formats['video'] ?? [] as $fmt)
                        <option value="{{ $fmt }}">{{ strtoupper($fmt) }}</option>
                    @endforeach
                </optgroup>

                <optgroup label="Audio">
                    @foreach ($formats['audio'] ?? [] as $fmt)
                        <option value="{{ $fmt }}">{{ strtoupper($fmt) }}</option>
                    @endforeach
                </optgroup>

                <optgroup label="Documents">
                    @foreach ($formats['document'] ?? [] as $fmt)
                        <option value="{{ $fmt }}">{{ strtoupper($fmt) }}</option>
                    @endforeach
                </optgroup>

                <optgroup label="Spreadsheets">
                    @foreach ($formats['spreadsheet'] ?? [] as $fmt)
                        <option value="{{ $fmt }}">{{ strtoupper($fmt) }}</option>
                    @endforeach
                </optgroup>

                <optgroup label="Presentations">
                    @foreach ($formats['presentation'] ?? [] as $fmt)
                        <option value="{{ $fmt }}">{{ strtoupper($fmt) }}</option>
                    @endforeach
                </optgroup>
            </select>
        </div>

        <br>
        <button type="submit">Convert</button>
    </form>

    <hr>

    <h2>Recent Conversions</h2>
    @if ($recentConversions->isEmpty())
        <p>No conversions yet.</p>
    @else
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>File</th>
                    <th>Source</th>
                    <th>Target</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recentConversions as $conversion)
                    <tr>
                        <td>{{ $conversion->source_filename }}</td>
                        <td>{{ strtoupper($conversion->source_extension) }}</td>
                        <td>{{ strtoupper($conversion->target_extension) }}</td>
                        <td>{{ $conversion->category }}</td>
                        <td>{{ $conversion->status->value }}</td>
                        <td>
                            <a href="{{ route('convert.show', $conversion->uuid) }}">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
