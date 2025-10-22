import { useState, useEffect } from 'react';
import { Button } from '@/components/ui/button';
import { Link } from 'react-router-dom';

export const CookieConsent = () => {
  const [showConsent, setShowConsent] = useState(false);

  useEffect(() => {
    const consent = localStorage.getItem('cookie-consent');
    if (!consent) {
      setShowConsent(true);
    }
  }, []);

  const acceptCookies = () => {
    localStorage.setItem('cookie-consent', 'accepted');
    setShowConsent(false);
  };

  const declineCookies = () => {
    localStorage.setItem('cookie-consent', 'declined');
    setShowConsent(false);
  };

  if (!showConsent) return null;

  return (
    <div className="fixed bottom-0 left-0 right-0 bg-card border-t border-border shadow-elegant p-4 z-50 animate-fade-in">
      <div className="container mx-auto flex flex-col md:flex-row items-center justify-between gap-4">
        <div className="text-sm text-muted-foreground">
          <p>
            Utilizamos cookies para melhorar a sua experiência. Ao continuar a navegar, concorda com a nossa{' '}
            <Link to="/politica-cookies" className="text-primary hover:underline">
              Política de Cookies
            </Link>{' '}
            e{' '}
            <Link to="/politica-privacidade" className="text-primary hover:underline">
              Política de Privacidade
            </Link>
            .
          </p>
        </div>
        <div className="flex gap-3">
          <Button variant="outline" size="sm" onClick={declineCookies}>
            Recusar
          </Button>
          <Button size="sm" onClick={acceptCookies}>
            Aceitar
          </Button>
        </div>
      </div>
    </div>
  );
};
