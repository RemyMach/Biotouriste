@component('mail::message')
    # Introduction
    Hi {{ $sender->user_name }}
    Your have sent this report to Admin :
    User Reported : {{ $userReported->user_name }}

    The categorie is {{ $report->categorie->Report_Categorie_label  }}

    @isset($report->announce)
        about the announce {{ $report->announce->announce_name }}
    @endisset

    The subject of the report is:
    {{ $report->report_subject }}

    The content is:
    {{ $report->report_comment }}

    And don't forget have a good day
    <br>
    {{ config('app.name') }}
@endcomponent