<form action="{{ route('sites.configurations.configStore', ['id' => encryptParams($site->id)]) }}" method="post"
    id="channel-form">
    @csrf
    <input type="hidden" name="selected_tab" value="EnvironmentKeys">
    <div class="card mb-1">
        <div class="card-body">

            <ul class="nav nav-pills mb-2" id="channelTab">

                <li class="nav-item">
                    <a class="nav-link active" id="channelsFormDataEmailTab" data-bs-toggle="tab"
                        href="#channelsFormDatasEmail" aria-controls="home" role="tab" aria-selected="true">
                        <svg width="27px" height="28px" xmlns="http://www.w3.org/2000/svg" width="34"
                            height="19" viewBox="0 0 34 19" fill="none">
                            <path
                                d="M4.81494 11.9C3.81494 11.9 2.71494 11.9 1.71494 11.9C1.21494 11.9 0.814941 11.6 0.814941 11.2C0.814941 10.8 1.11494 10.5 1.71494 10.5C3.81494 10.5 5.91494 10.5 7.91494 10.5C8.41494 10.5 8.71494 10.8 8.81494 11.2C8.81494 11.7 8.51494 11.9 8.01494 11.9C6.91494 11.9 5.91494 11.9 4.81494 11.9Z"
                                fill="#706473" />
                            <path
                                d="M5.91514 6.8999C6.61514 6.8999 7.31514 6.8999 7.91514 6.8999C8.41514 6.8999 8.71514 7.1999 8.71514 7.5999C8.71514 7.9999 8.41514 8.3999 7.91514 8.3999C6.51514 8.3999 5.21514 8.3999 3.81514 8.3999C3.41514 8.2999 3.01514 7.9999 3.01514 7.5999C3.01514 7.1999 3.41514 6.8999 3.81514 6.8999C4.61514 6.8999 5.21514 6.8999 5.91514 6.8999Z"
                                fill="#706473" />
                            <path
                                d="M33.4148 3C33.4148 2.7 33.4148 2.5 33.3148 2.2C32.9148 0.8 31.8148 0 30.3148 0C24.0148 0 17.7148 0 11.3148 0C10.2148 0 9.11476 0 8.01476 0C6.61476 0 5.51476 1 5.31476 2.3C5.21476 2.8 5.31476 3.3 5.21476 3.8C5.21476 4.3 5.51476 4.7 5.91476 4.7C6.31476 4.7 6.61476 4.4 6.61476 3.9C6.61476 3.5 6.61476 3.2 6.61476 2.8C6.61476 2.7 6.61476 2.6 6.71476 2.5C6.81476 2.4 6.91476 2.6 7.01476 2.6C9.51476 4.8 12.0148 6.9 14.5148 9.1C14.7148 9.3 14.7148 9.4 14.5148 9.6C12.4148 11.3 10.4148 13.1 8.31476 14.9C7.81476 15.4 7.21476 15.8 6.61476 16.3C6.51476 15.8 6.61476 15.4 6.61476 15C6.61476 14.8 6.61476 14.7 6.51476 14.5C6.41476 14.2 6.11476 14 5.71476 14C5.41476 14 5.11476 14.3 5.11476 14.6C5.11476 15.2 5.01476 15.7 5.11476 16.3C5.31476 17.7 6.61476 18.7 8.11476 18.7C15.4148 18.7 22.8148 18.7 30.1148 18.7C30.3148 18.7 30.6148 18.7 30.8148 18.6C32.2148 18.3 33.1148 17.2 33.1148 15.6C33.4148 11.5 33.4148 7.3 33.4148 3ZM8.11476 1.7C8.01476 1.7 8.01476 1.6 7.81476 1.5C15.5148 1.5 23.1148 1.5 30.7148 1.5C30.5148 1.7 30.4148 1.8 30.2148 1.9C26.8148 4.8 23.3148 7.8 19.9148 10.7C19.3148 11.2 19.1148 11.2 18.4148 10.7C15.1148 7.7 11.6148 4.7 8.11476 1.7ZM7.81476 17.3C8.41476 16.8 8.91476 16.4 9.41476 16C11.5148 14.2 13.6148 12.4 15.7148 10.6C15.9148 10.4 16.0148 10.4 16.2148 10.6C16.7148 11.1 17.3148 11.6 17.9148 12.1C18.8148 12.8 19.9148 12.8 20.7148 12.1C21.3148 11.6 21.9148 11.1 22.5148 10.6C22.6148 10.5 22.7148 10.5 22.9148 10.6C25.5148 12.8 28.1148 15.1 30.7148 17.3L30.8148 17.4C23.1148 17.3 15.5148 17.3 7.81476 17.3ZM31.9148 16.3C31.0148 15.5 30.2148 14.8 29.3148 14.1C27.5148 12.6 25.8148 11.1 24.0148 9.6C23.8148 9.4 23.8148 9.4 24.0148 9.2C26.6148 7 29.2148 4.8 31.7148 2.6C31.7148 2.6 31.8148 2.6 31.9148 2.5C31.9148 7.1 31.9148 11.7 31.9148 16.3Z"
                                fill="#706473" />
                        </svg>
                        &nbsp;
                        <span class="fw-bold">Email </span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="channelsFormDataTwilioTab" data-bs-toggle="tab"
                        href="#channelsFormDatasTwilio" aria-controls="home" role="tab" aria-selected="true">
                        <svg width="22px" xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                            viewBox="0 0 30 30" fill="none">
                            <path
                                d="M0.615234 14.7001C0.615234 6.7001 7.01524 0.300096 14.9152 0.200096C23.1152 0.100096 29.7152 6.70009 29.7152 14.8001C29.7152 22.9001 23.1152 29.5001 14.8152 29.3001C6.91524 29.0001 0.615234 22.6001 0.615234 14.7001ZM15.1152 27.5001C22.1152 27.5001 27.8152 21.9001 28.0152 15.0001C28.2152 7.7001 22.4152 1.9001 15.5152 1.7001C8.21524 1.5001 2.31524 7.4001 2.31524 14.5001C2.21524 21.8001 7.91523 27.5001 15.1152 27.5001Z"
                                fill="#666666" />
                            <path
                                d="M10.7151 7C12.5151 7 13.9151 8.4 13.9151 10.2C13.9151 12 12.5151 13.4 10.7151 13.4C8.91514 13.4 7.51514 12 7.51514 10.2C7.51514 8.4 8.91514 7 10.7151 7Z"
                                fill="#666666" />
                            <path
                                d="M22.815 10.2C22.815 12 21.415 13.4 19.615 13.4C17.815 13.4 16.415 12 16.415 10.2C16.415 8.4 17.815 7 19.615 7C21.315 7 22.815 8.4 22.815 10.2Z"
                                fill="#666666" />
                            <path
                                d="M13.815 19.2001C13.815 21.0001 12.315 22.4001 10.615 22.4001C8.81504 22.4001 7.41504 20.9001 7.41504 19.2001C7.41504 17.4001 8.91504 16.0001 10.615 16.0001C12.415 15.9001 13.915 17.4001 13.815 19.2001Z"
                                fill="#666666" />
                            <path
                                d="M19.615 15.9001C21.415 15.9001 22.815 17.4001 22.815 19.1001C22.815 20.9001 21.315 22.3001 19.615 22.3001C17.815 22.3001 16.415 20.8001 16.415 19.1001C16.415 17.3001 17.815 15.9001 19.615 15.9001Z"
                                fill="#666666" />
                        </svg>
                        &nbsp;
                        <span class="fw-bold">Twilio </span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="channelsFormDataLifetimeTab" data-bs-toggle="tab"
                        href="#channelsFormDatasLifetime" aria-controls="home" role="tab" aria-selected="true">
                        <svg width="22px" xmlns="http://www.w3.org/2000/svg" width="30" height="28"
                            viewBox="0 0 30 28" fill="none">
                            <path
                                d="M29.315 3.20005C29.115 1.80005 27.915 0.800049 26.415 0.800049C21.015 0.800049 15.615 0.800049 10.215 0.800049C8.91503 0.800049 7.71504 1.90005 7.51504 3.20005C7.41504 4.10005 7.51504 4.90005 7.51504 5.80005C7.51504 6.00005 7.41503 6.10005 7.21503 6.10005C6.11503 6.10005 4.91504 6.10005 3.81504 6.10005C2.11504 6.10005 0.915039 7.50005 0.915039 9.10005C0.915039 12.4 0.915039 15.8 0.915039 19.1C0.915039 20.5 2.21504 21.8 3.61504 21.8C4.51504 21.8 5.41504 21.8 6.41504 21.8C6.61504 21.8 6.71503 21.9 6.71503 22.1C6.71503 23.4 6.71503 24.7 6.71503 26C6.71503 26.2 6.71503 26.4 6.71503 26.6C6.71503 26.8 6.81504 27 7.01504 27.1C7.21504 27.2 7.41504 27.1 7.51504 27C7.61504 26.9 7.71503 26.8001 7.71503 26.7001C9.11503 25.2001 10.515 23.7 11.815 22.1C11.915 21.9 12.115 21.9001 12.315 21.9001C14.815 21.9001 17.315 21.9001 19.815 21.9001C21.215 21.9001 22.315 21.1001 22.715 19.7001C22.815 19.5001 22.815 19.3 22.815 19C23.215 19.5 23.715 20.0001 24.115 20.4001C24.515 20.8001 24.815 21.2 25.215 21.6C25.415 21.8 25.515 21.8 25.815 21.8C26.015 21.7 26.115 21.5 26.115 21.3C26.115 21.2 26.115 21.2 26.115 21.1C26.115 19.7 26.115 18.4 26.115 17C26.115 16.6 26.115 16.6 26.515 16.6C27.515 16.6 28.315 16.2001 28.915 15.4001C29.215 15.1001 29.315 14.6001 29.415 14.2001C29.315 10.5001 29.315 6.80005 29.315 3.20005ZM19.415 20.5C16.915 20.5 14.415 20.5 11.915 20.5C11.615 20.5 11.415 20.6 11.215 20.8C10.115 22.1 8.91504 23.3 7.81504 24.6C7.71504 24.7 7.71504 24.7 7.61504 24.8C7.61504 23.6 7.61504 22.4001 7.61504 21.2001C7.61504 20.6001 7.51504 20.5 6.91504 20.5C5.91504 20.5 4.91504 20.5 4.01504 20.5C3.11504 20.5 2.41503 20.0001 2.21503 19.2001C2.11503 19.0001 2.11504 18.8 2.11504 18.6C2.11504 15.5 2.11504 12.4 2.11504 9.30005C2.11504 8.30005 2.61504 7.60005 3.51504 7.40005C3.71504 7.40005 3.81504 7.40005 4.01504 7.40005C9.11504 7.40005 14.315 7.40005 19.415 7.40005C20.315 7.40005 21.015 7.90005 21.315 8.80005C21.315 9.00005 21.315 9.20005 21.315 9.30005C21.315 12.4 21.315 15.6001 21.315 18.7001C21.415 19.7001 20.515 20.5 19.415 20.5ZM27.915 13.3C27.915 14.5 27.215 15.2001 25.915 15.2001C25.715 15.2001 25.515 15.2001 25.215 15.2001C24.815 15.2001 24.615 15.4 24.615 15.8C24.615 17 24.615 18.2 24.615 19.5C23.815 18.7 23.115 17.9 22.415 17.1C22.315 17 22.315 16.9 22.315 16.8C22.315 14.2 22.315 11.6 22.315 9.00005C22.315 7.80005 21.815 7.00005 20.815 6.40005C20.515 6.20005 20.115 6.10005 19.815 6.10005C16.215 6.10005 12.615 6.10005 9.11504 6.10005C8.91504 6.10005 8.81504 6.10005 8.81504 5.80005C8.81504 5.20005 8.81504 4.50005 8.81504 3.90005C8.81504 2.90005 9.51503 2.00005 10.715 2.00005C13.715 2.00005 16.615 2.00005 19.615 2.00005C21.715 2.00005 23.915 2.00005 26.015 2.00005C26.915 2.00005 27.515 2.50005 27.815 3.30005C27.915 3.50005 27.915 3.70005 27.915 3.90005C27.915 7.20005 27.915 10.3 27.915 13.3Z"
                                fill="#6A6270" />
                            <path
                                d="M11.7152 14.5001C9.71523 14.5001 7.71524 14.5001 5.81524 14.5001C5.71524 14.5001 5.61524 14.5001 5.41524 14.5001C5.21524 14.4001 5.11523 14.3001 5.11523 14.1001C5.11523 13.9001 5.21524 13.7001 5.41524 13.6001C5.51524 13.6001 5.61524 13.6001 5.81524 13.6001C9.71524 13.6001 13.7152 13.6001 17.6152 13.6001C18.1152 13.6001 18.4152 13.8001 18.3152 14.1001C18.3152 14.4001 18.0152 14.6001 17.6152 14.6001C15.7152 14.5001 13.7152 14.5001 11.7152 14.5001Z"
                                fill="#6A6270" />
                            <path
                                d="M11.7152 17.4001C9.71523 17.4001 7.71523 17.4001 5.71523 17.4001C5.31523 17.4001 5.11523 17.2001 5.11523 16.9001C5.11523 16.7001 5.21524 16.5001 5.51524 16.4001C5.61524 16.4001 5.71524 16.4001 5.91524 16.4001C9.91524 16.4001 13.8152 16.4001 17.8152 16.4001C18.3152 16.4001 18.5152 16.6001 18.5152 16.9001C18.5152 17.2001 18.3152 17.4001 17.8152 17.4001C15.7152 17.4001 13.7152 17.4001 11.7152 17.4001Z"
                                fill="#6A6270" />
                            <path
                                d="M8.61523 10.7001C9.61523 10.7001 10.6152 10.7001 11.6152 10.7001C11.8152 10.7001 12.1152 10.8001 12.2152 11.0001C12.3152 11.3001 12.2152 11.5001 11.9152 11.6001C11.8152 11.6001 11.8152 11.6001 11.7152 11.6001C9.71523 11.6001 7.71523 11.6001 5.71523 11.6001C5.31523 11.6001 5.11523 11.4001 5.11523 11.1001C5.11523 10.8001 5.31523 10.6001 5.71523 10.6001C6.71523 10.7001 7.61523 10.7001 8.61523 10.7001Z"
                                fill="#6A6270" />
                        </svg>
                        &nbsp;
                        <span class="fw-bold">Lifetime SMS </span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="onedriveTab" data-bs-toggle="tab" href="#tabOnedrive" aria-controls="home"
                        role="tab" aria-selected="true">
                        <svg width="25" height="27" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 20.41">
                            <defs>
                                <style>
                                    .cls-1 {
                                        fill: #706473;
                                    }
                                </style>
                            </defs>
                            <g id="Layer_2" data-name="Layer 2">
                                <g id="Layer_1-2" data-name="Layer 1">
                                    <path class="cls-1"
                                        d="M29.4,13.81H29c-.2,0-.24.06-.25.25a4.91,4.91,0,0,1-.41,1.78l-9.77-6c.71-.33,1.39-.59,2-.93a6.28,6.28,0,0,1,4-.45,4.75,4.75,0,0,1,3.9,3.5c.08.24,0,.61.24.7s.53-.07.8-.09.33-.16.27-.41a6.25,6.25,0,0,0-4.41-4.79.64.64,0,0,1-.47-.44A10.65,10.65,0,0,0,12.09.4c-1,.28-.95.28-.61,1.17.09.23.17.26.41.18a9.21,9.21,0,0,1,6.4.07,9.06,9.06,0,0,1,5.49,5.39h-1a5.38,5.38,0,0,0-2.49.54c-.88.4-1.77.79-2.65,1.21a.49.49,0,0,1-.53,0C15.5,8,13.91,7,12.33,6A8.27,8.27,0,0,0,9.94,5a9.12,9.12,0,0,0-2.24-.2c.24-.29.59-.53.58-.77s-.42-.44-.63-.69-.23-.1-.35,0a8.65,8.65,0,0,0-.9,1.19A.74.74,0,0,1,5.89,5a7.89,7.89,0,0,0-5.75,9.2A7.78,7.78,0,0,0,7.61,20.4c5.31,0,10.62,0,15.93,0a5.65,5.65,0,0,0,1.08-.11A6.64,6.64,0,0,0,30,14.46C30,13.81,30,13.81,29.4,13.81ZM2,15.67a6.64,6.64,0,0,1,4.61-9.6,6.83,6.83,0,0,1,4.75.76c1.55.92,3.09,1.87,4.7,2.85l-3.53,1.61-10,4.55C2.19,16,2.09,15.94,2,15.67Zm21.3,3.54H7.93A6.65,6.65,0,0,1,2.87,17l2.21-1,11.79-5.36a.7.7,0,0,1,.75.05c3.27,2,6.56,4,9.84,6l.33.21A5.43,5.43,0,0,1,23.25,19.21Z" />
                                </g>
                            </g>
                        </svg>
                        &nbsp;
                        <span class="fw-bold">OneDrive </span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="fcmTab" data-bs-toggle="tab" href="#tabFcm" aria-controls="home"
                        role="tab" aria-selected="true">
                        <svg class="c_fcm" xmlns="http://www.w3.org/2000/svg" width="18" viewBox="0 0 20.64 27.88">
                            <defs>
                                <style>
                                    .cls-1 {
                                        fill: none;
                                    }

                                    .cls-1,
                                    .cls-2 {
                                        stroke: #6d6472;
                                        stroke-miterlimit: 10;
                                    }

                                    .cls-2 {
                                        fill: #fff;
                                    }
                                </style>
                            </defs>
                            <g id="Layer_2" data-name="Layer 2">
                                <g id="Layer_1-2" data-name="Layer 1">
                                    <path class="cls-1"
                                        d="M16.87,6a.61.61,0,0,0-.34.17L13.35,9.35,10.87,4.6A.61.61,0,0,0,10,4.34h0a.65.65,0,0,0-.26.26L8.43,7.2,5,.82A.61.61,0,0,0,4.18.57h0A.61.61,0,0,0,3.86,1L.55,22.17l8.84,5a1.87,1.87,0,0,0,1.78,0l8.92-5L17.57,6.51A.62.62,0,0,0,16.87,6Z" />
                                    <path class="cls-2" d="M14.19,8.52.55,22.19" />
                                    <path class="cls-2" d="M11,11.81c-.88-1.55-1.77-3.09-2.66-4.64" />
                                    <path class="cls-2" d="M.55,22.19,9.73,4.61" />
                                </g>
                            </g>
                        </svg>
                        {{-- <svg class="c_fcm" xmlns="http://www.w3.org/2000/svg" width="18" style="stroke: white;" viewBox="0 0 20.64 27.88"><defs><style>.cls-1{fill:none;}.cls-1,.cls-2{stroke:#6d6472;stroke-miterlimit:10;}.cls-2{fill:#fff;}</style></defs><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path class="cls-1" d="M16.87,6a.61.61,0,0,0-.34.17L13.35,9.35,10.87,4.6A.61.61,0,0,0,10,4.34h0a.65.65,0,0,0-.26.26L8.43,7.2,5,.82A.61.61,0,0,0,4.18.57h0A.61.61,0,0,0,3.86,1L.55,22.17l8.84,5a1.87,1.87,0,0,0,1.78,0l8.92-5L17.57,6.51A.62.62,0,0,0,16.87,6Z"/><path class="cls-2" d="M14.19,8.52.55,22.19"/><path class="cls-2" d="M11,11.81c-.88-1.55-1.77-3.09-2.66-4.64"/><path class="cls-2" d="M.55,22.19,9.73,4.61"/></g></g></svg> --}}
                        &nbsp;
                        <span class="fw-bold">Fcm </span></a>
                </li>

            </ul>

            <div class="tab-content">

                <div class="tab-pane active" id="channelsFormDatasEmail" aria-labelledby="channelsFormDataEmailTab"
                    role="tabpanel">
                    <div class="card mb-1" style="border: 1px solid #a098f5; border-style: dashed; border-radius: 0;">

                        <div class="card-body">

                            <div class="row mb-2">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 position-relative mb-2">
                                    <label class="form-label fs-6" for="mailgun_domain">Mailgun Domain<span
                                            class="text-danger">*</span></label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text disabled"
                                            id="mailgun_domain">https://api.mailgun.net/v3/</span>

                                        <input type="text"
                                            class="form-control form-control-md fs-6 @error('mailgun_domain') is-invalid @enderror"
                                            aria-describedby="mailgun_domain" id="mailgun_domain"
                                            name="mailgun_domain" placeholder="Mailgun Domain"
                                            value="{{ isset($email_channel) ? $email_channel->mailgun_domain : old('mailgun_domain') }}">
                                        @error('mailgun_domain')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 position-relative mb-2">
                                    <label class="form-label fs-6" for="mailgun_secret">Mailgun Secret<span
                                            class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control form-control-md fs-6 @error('mailgun_secret') is-invalid @enderror"
                                        id="mailgun_secret" name="mailgun_secret" placeholder="Mailgun Secret"
                                        value="{{ isset($email_channel) ? $email_channel->mailgun_secret : old('mailgun_secret') }}">
                                    @error('mailgun_secret')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- <div class="col-lg-6 col-md-6 col-sm-6 col-12 position-relative mb-1">
                                        <label class="form-label fs-5" for="sender_email">Sender Email<span
                                                class="text-danger">*</span></label>
                                        <input type="email"
                                            class="form-control form-control-lg @error('sender_email') is-invalid @enderror"
                                            id="sender_email" name="sender_email" placeholder="Sender Email"
                                            value="{{ isset($email_channel) ? $email_channel->sender_email : old('sender_email') }}">
                                        @error('sender_email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div> --}}

                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 position-relative mb-2">
                                    <label class="form-label fs-6" for="sender_name">Sender Name<span
                                            class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control form-control-md fs-6 @error('sender_name') is-invalid @enderror"
                                        id="sender_name" name="sender_name" placeholder="Sender Email"
                                        value="{{ isset($email_channel) ? $email_channel->sender_name : old('sender_name') }}">
                                    @error('sender_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 position-relative mb-2">
                                    <label class="form-label fs-6" for="isActive">Status</label>
                                    <div class="form-check form-switch form-check-success">
                                        <input type="checkbox" class="form-check-input " style="cursor:pointer"
                                            name="emailIsActive" id="isActive"
                                            @isset($email_channel) @if ($email_channel->isActive) checked @endif @endisset />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="tab-pane " id="channelsFormDatasTwilio" aria-labelledby="channelsFormDataTwilioTab"
                    role="tabpanel">
                    <div class="card mb-1" style="border: 1px solid #a098f5; border-style: dashed; border-radius: 0;">

                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 position-relative mb-2">
                                    <label class="form-label fs-6" for="twilio_sid">Twilio
                                        SID<span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control form-control-md fs-6 @error('twilio_sid') is-invalid @enderror"
                                        id="twilio_sid" name="twilio_sid" placeholder="Twilio SID"
                                        value="{{ isset($sms_channel) ? $sms_channel->twilio_sid : old('twilio_sid') }}">
                                    @error('twilio_sid')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 position-relative mb-2">
                                    <label class="form-label fs-6" for="twilio_auth_token">Twilio
                                        Auth Token<span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control form-control-md fs-6 @error('twilio_auth_token') is-invalid @enderror"
                                        id="twilio_auth_token" name="twilio_auth_token"
                                        placeholder="Twilio Auth Token"
                                        value="{{ isset($sms_channel) ? $sms_channel->twilio_auth_token : old('twilio_auth_token') }}">
                                    @error('twilio_auth_token')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 position-relative mb-2">
                                    <label class="form-label fs-6" for="twilio_number">Twilio
                                        Number<span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control form-control-md fs-6 @error('twilio_number') is-invalid @enderror"
                                        id="twilio_number" name="twilio_number" placeholder="Twilio Number"
                                        value="{{ isset($sms_channel) ? $sms_channel->twilio_number : old('twilio_number') }}">
                                    @error('twilio_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 position-relative mb-2">
                                    <label class="form-label fs-6" for="twilio_status">Status</label>
                                    <div class="form-check form-switch form-check-success">
                                        <input type="checkbox" class="form-check-input " style="cursor:pointer"
                                            name="twilio_status" id="twilio_status"
                                            @isset($sms_channel) @if ($sms_channel->twilio_status) checked @endif @endisset />
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="tab-pane " id="channelsFormDatasLifetime" aria-labelledby="channelsFormDataLifetimeTab"
                    role="tabpanel">
                    <div class="card mb-1" style="border: 1px solid #a098f5; border-style: dashed; border-radius: 0;">

                        <div class="card-body">

                            <div class="row mb-2">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 position-relative mb-2">
                                    <label class="form-label fs-6" for="lifetime_sms_api_token">LifeTime Sms Api
                                        Token<span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control form-control-md fs-6 @error('lifetime_sms_api_token') is-invalid @enderror"
                                        id="lifetime_sms_api_token" name="lifetime_sms_api_token"
                                        placeholder="Lifetime Sms API Token"
                                        value="{{ isset($sms_channel) ? $sms_channel->lifetime_sms_api_token : old('lifetime_sms_api_token') }}">
                                    @error('lifetime_sms_api_token')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 position-relative mb-2">
                                    <label class="form-label fs-6" for="lifetime_sms_api_secret">Lifetime Sms Api
                                        Secret<span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control form-control-md fs-6 @error('lifetime_sms_api_secret') is-invalid @enderror"
                                        id="lifetime_sms_api_secret" name="lifetime_sms_api_secret"
                                        placeholder="Lifetime Sms Api Secret"
                                        value="{{ isset($sms_channel) ? $sms_channel->lifetime_sms_api_secret : old('lifetime_sms_api_secret') }}">
                                    @error('lifetime_sms_api_secret')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-4 col-12 position-relative mb-2">
                                    <label class="form-label fs-6" for="short_code">Short
                                        Code<span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control form-control-md fs-6 @error('short_code') is-invalid @enderror"
                                        id="short_code" name="short_code" placeholder="Short Code"
                                        value="{{ isset($sms_channel) ? $sms_channel->short_code : old('short_code') }}"
                                        disabled>
                                    @error('short_code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-4 col-12 position-relative mb-2">
                                    <label class="form-label fs-6" for="brand_name">Brand
                                        Name<span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control form-control-md fs-6 @error('brand_name') is-invalid @enderror"
                                        id="brand_name" name="brand_name" placeholder="Brand Name"
                                        value="{{ isset($sms_channel) ? $sms_channel->brand_name : old('brand_name') }}">
                                    @error('brand_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-4 position-relative mb-2">
                                    <label class="form-label fs-6" for="lifetime_status">Status</label>
                                    <div class="form-check form-switch form-check-success">
                                        <input type="checkbox" class="form-check-input " style="cursor:pointer"
                                            name="lifetime_status" id="lifetime_status"
                                            @isset($sms_channel) @if ($sms_channel->lifetime_status) checked @endif @endisset />
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="tab-pane " id="tabOnedrive" aria-labelledby="onedriveTab" role="tabpanel">
                    <div class="card mb-1" style="border: 1px solid #a098f5; border-style: dashed; border-radius: 0;">

                        <div class="card-body">

                            <div class="row mb-2">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 position-relative mb-2">
                                    <label class="form-label fs-6" for="onedrive_client_id">Client ID<span
                                            class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control form-control-md fs-6 @error('onedrive_client_id') is-invalid @enderror"
                                        id="onedrive_client_id" name="onedrive_client_id" placeholder="Client ID"
                                        value="{{ isset($siteConfigration) ? $siteConfigration->onedrive_client_id : old('onedrive_client_id') }}">
                                    @error('onedrive_client_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane " id="tabFcm" aria-labelledby="fcmTab" role="tabpanel">
                    <div class="card mb-1" style="border: 1px solid #a098f5; border-style: dashed; border-radius: 0;">

                        <div class="card-body">

                            <div class="row mb-2">
                                <div class="col-12 position-relative mb-2">
                                    <label class="form-label fs-6" for="fcm_key">Key<span
                                            class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control form-control-md fs-6 @error('fcm_key') is-invalid @enderror"
                                        id="fcm_key" name="fcm_key" placeholder="Fcm Key"
                                        value="{{ isset($siteConfigration) ? $siteConfigration->fcm_key : old('fcm_key') }}">
                                    @error('fcm_key')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="d-flex align-items-center justify-content-end">
                @can('sites.configurations.configStore')
                    <button type="submit" class="btn btn-outline-success waves-effect waves-float waves-light me-1">
                        <i data-feather='save'></i>
                        Update Configurations
                    </button>
                @endcan

                <button type="reset"
                    class="btn removeErrorMessage btn-outline-danger waves-effect waves-float waves-light">
                    <i data-feather='x'></i>
                    Reset
                </button>
            </div>
        </div>
    </div>
</form>
