<div class="panel-card">

    <div class="panel-title">

        <h2>Project Files</h2>

        <form action="{{ route('projects.files.upload', $project) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <input type="file"
                   id="projectFile"
                   name="file"
                   hidden
                   onchange="this.form.submit()">

            <button type="button"
                    class="new-task-btn"
                    onclick="document.getElementById('projectFile').click()">
                + Upload File
            </button>

        </form>

    </div>

    <div class="team-card-large">

        @forelse($project->projectFiles as $file)

            <div class="file-row">

                <div class="file-icon">
                    📄
                </div>

                <div class="file-info">

                    <h4>{{ $file->name }}</h4>

                    <p>
                        {{ $file->user->name }}
                        •
                        {{ number_format($file->size / 1024, 1) }} KB
                        •
                        {{ $file->created_at->diffForHumans() }}
                    </p>

                </div>

                <div class="file-type">
                    <span>
                        {{ strtoupper(pathinfo($file->name, PATHINFO_EXTENSION)) }}
                    </span>
                </div>

                <div class="file-actions">

                    <a href="{{ asset('storage/'.$file->path) }}"
                       target="_blank"
                       class="file-preview">
                        👁 Preview
                    </a>

                    <a href="{{ route('projects.files.download', $file) }}"
                       class="file-download">
                        ⬇ Download
                    </a>

                </div>

            </div>

        @empty

            <p class="muted" style="text-align:center;padding:40px;">
                No files uploaded yet.
            </p>

        @endforelse

    </div>

</div>