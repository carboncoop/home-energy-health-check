@component('mail::message')
Dear {{ $assessment['homeowner_name'] }},

On {{ $assessment['assessment_date'] }}, a Home Energy Assessment was carried out in your home by {{ $assessment['assessor_name'] }} (Plymouth Energy Community Energy Advisor).

Please find attached your personalised practical guide to keeping your home warm and healthy. It details the results of the energy assessment, recommendations and handy tips to help you.

Some recommendations may include measures which cost money. If you stay in touch with us, we can notify you when different grants become available to help. The easiest way to do this is to become a member of Plymouth Energy Community. It’s free, you’ll get regular updates and you can even have a say in how our organisation is run. <a href="http://www.plymouthenergycommunity.com/get-involved/member">Click here to join.</a>

Our Energy Team are on hand to answer any questions and help you to take forward some of the recommendations listed, please call us on 01752 477117 or reply to this email.

Thank-you for your time.

Kind regards,


Plymouth Energy Community Energy Team

General enquiries: 01752 477117

E: energyteam@plymouthenergycommunity.com

@endcomponent
