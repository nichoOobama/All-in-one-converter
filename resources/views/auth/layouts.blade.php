<!DOCTYPE html>

<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Sign In - All In One Converter</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "on-primary": "#ffffff",
                    "surface-container-high": "#dee8ff",
                    "surface-tint": "#1d59c1",
                    "secondary-fixed": "#d3e4fe",
                    "primary-container": "#0f52ba",
                    "outline": "#737784",
                    "primary": "#003c90",
                    "surface-container-lowest": "#ffffff",
                    "primary-fixed": "#d9e2ff",
                    "inverse-primary": "#b0c6ff",
                    "surface": "#f9f9ff",
                    "inverse-on-surface": "#ecf1ff",
                    "outline-variant": "#c3c6d5",
                    "on-surface": "#111c2d",
                    "on-tertiary-fixed-variant": "#43474b",
                    "tertiary": "#3c4144",
                    "surface-container-highest": "#d8e3fb",
                    "on-primary-fixed-variant": "#00419c",
                    "primary-fixed-dim": "#b0c6ff",
                    "on-error-container": "#93000a",
                    "on-error": "#ffffff",
                    "secondary": "#505f76",
                    "on-tertiary": "#ffffff",
                    "inverse-surface": "#263143",
                    "on-secondary-fixed-variant": "#38485d",
                    "on-primary-container": "#bcceff",
                    "surface-container-low": "#f0f3ff",
                    "on-tertiary-container": "#caced2",
                    "error-container": "#ffdad6",
                    "on-background": "#111c2d",
                    "surface-bright": "#f9f9ff",
                    "secondary-fixed-dim": "#b7c8e1",
                    "tertiary-container": "#53585c",
                    "on-tertiary-fixed": "#171c1f",
                    "tertiary-fixed-dim": "#c3c7cb",
                    "surface-container": "#e7eeff",
                    "on-secondary-container": "#54647a",
                    "surface-dim": "#cfdaf2",
                    "on-surface-variant": "#434653",
                    "tertiary-fixed": "#dfe3e7",
                    "on-primary-fixed": "#001945",
                    "background": "#f9f9ff",
                    "secondary-container": "#d0e1fb",
                    "surface-variant": "#d8e3fb",
                    "on-secondary-fixed": "#0b1c30",
                    "on-secondary": "#ffffff",
                    "error": "#ba1a1a"
            },
            "borderRadius": {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "full": "9999px"
            },
            "spacing": {
                    "stack-lg": "32px",
                    "gutter": "24px",
                    "margin-mobile": "16px",
                    "margin-desktop": "40px",
                    "unit": "8px",
                    "stack-md": "16px",
                    "container-max": "1200px",
                    "stack-sm": "8px"
            },
            "fontFamily": {
                    "label-md": ["Inter"],
                    "label-sm": ["Inter"],
                    "display": ["Inter"],
                    "body-md": ["Inter"],
                    "headline-lg": ["Inter"],
                    "body-lg": ["Inter"],
                    "headline-lg-mobile": ["Inter"],
                    "headline-md": ["Inter"],
                    "body-sm": ["Inter"]
            },
            "fontSize": {
                    "label-md": ["14px", {"lineHeight": "16px", "letterSpacing": "0.01em", "fontWeight": "600"}],
                    "label-sm": ["12px", {"lineHeight": "14px", "fontWeight": "500"}],
                    "display": ["48px", {"lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                    "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                    "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600"}],
                    "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                    "headline-lg-mobile": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                    "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                    "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}]
            }
          },
        },
      }
    </script>
<style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9f9ff;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        .login-card {
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.03);
            border: 1px solid #E2E8F0;
        }
        .input-focus-ring:focus {
            outline: none;
            border-color: #003c90;
            box-shadow: 0 0 0 2px rgba(0, 60, 144, 0.1);
        }
        .ambient-shadow {
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.03);
        }
    </style>
</head>
<body class="bg-background text-on-background min-h-screen flex flex-col">
    @yield('content')
</body></html>