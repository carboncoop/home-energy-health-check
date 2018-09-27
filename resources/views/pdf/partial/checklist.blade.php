<h3 class="mt-4">Home Visit Checklist</h3>
<div class="card card-responses p-2 my-2">
    @foreach ($checklistSchema as $field => $label)
        <div class="row response-row padded-row">
            <div class="col col-12">
                <strong class="response-label">{{ $label }}:</strong>
                <span class="pl-1">{{ $assessment[$field] }}</span>
            </div>
        </div>
    @endforeach
</div>
