 <style>
  
        /* Animasi untuk transisi */
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #evaluationForm {
            display: none;
            animation: slideDown 0.5s ease-out forwards;
        }

        /* Style untuk tombol yang sudah diklik */
        .btn-saved {
            background-color: #28a745 !important;
            border-color: #28a745 !important;
        }
 

        /* Style untuk visual feedback */
        .form-saved {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Style untuk loading state */
        .btn-loading {
            position: relative;
            pointer-events: none;
        }

        .btn-loading:after {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .hover-scale {
            transition: transform 0.3s ease;
        }

        .hover-scale:hover {
            transform: translateY(-5px);
        }

        .ribbon {
            width: 85px;
            height: 88px;
            overflow: hidden;
            position: absolute;
            top: -3px;
            right: -3px;
        }

        .ribbon span {
            position: absolute;
            display: block;
            width: 125px;
            padding: 8px 0;
            background-color: #28a745;
            box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
            color: #fff;
            font-size: 12px;
            text-align: center;
            right: -5px;
            top: 20px;
            transform: rotate(45deg);
        }

        .progress-bar {
            transition: width 1.5s ease;
        }

        .bg-gradient-success {
            background: linear-gradient(45deg, #28a745, #20c997);
        }

        .bg-gradient-info {
            background: linear-gradient(45deg, #17a2b8, #0dcaf0);
        }

        .bg-gradient-warning {
            background: linear-gradient(45deg, #ffc107, #fd7e14);
        }

        .accordion-button:not(.collapsed) {
            background-color: rgba(13, 110, 253, 0.1);
            color: #0d6efd;
        }

        code {
            font-size: 1.1em;
            color: #d63384;
        }
    </style>