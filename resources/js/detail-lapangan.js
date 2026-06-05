tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fade-in 0.5s ease-out',
                        'slide-up': 'slide-up 0.7s ease-out',
                        'slide-left': 'slide-left 0.7s ease-out',
                        'float': 'float 3s ease-in-out infinite',
                        'text-shimmer': 'text-shimmer 2s ease-in-out infinite',
                    },
                    keyframes: {
                        'fade-in': {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' }
                        },
                        'slide-up': {
                            '0%': { transform: 'translateY(20px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' }
                        },
                        'slide-left': {
                            '0%': { transform: 'translateX(20px)', opacity: '0' },
                            '100%': { transform: 'translateX(0)', opacity: '1' }
                        },
                        'float': {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' }
                        },
                        'text-shimmer': {
                            '0%': { backgroundPosition: '100% 50%' },
                            '100%': { backgroundPosition: '0% 50%' }
                        }
                    }
                }
            }
};