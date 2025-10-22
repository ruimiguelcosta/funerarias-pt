import { Toaster } from "@/components/ui/toaster";
import { Toaster as Sonner } from "@/components/ui/sonner";
import { TooltipProvider } from "@/components/ui/tooltip";
import { QueryClient, QueryClientProvider } from "@tanstack/react-query";
import { BrowserRouter, Routes, Route } from "react-router-dom";
import Index from "./pages/Index";
import FuneralHomes from "./pages/FuneralHomes";
import FuneralHomeDetail from "./pages/FuneralHomeDetail";
import BlogPostDetail from "./pages/BlogPostDetail";
import About from "./pages/About";
import CookiePolicy from "./pages/CookiePolicy";
import PrivacyPolicy from "./pages/PrivacyPolicy";
import NotFound from "./pages/NotFound";
import { CookieConsent } from "./components/CookieConsent";

const queryClient = new QueryClient();

const App = () => (
  <QueryClientProvider client={queryClient}>
    <TooltipProvider>
      <Toaster />
      <Sonner />
      <BrowserRouter>
        <Routes>
          <Route path="/" element={<Index />} />
          <Route path="/funerarias" element={<FuneralHomes />} />
          <Route path="/funeraria/:id" element={<FuneralHomeDetail />} />
          <Route path="/post/:id" element={<BlogPostDetail />} />
          <Route path="/quem-somos" element={<About />} />
          <Route path="/politica-cookies" element={<CookiePolicy />} />
          <Route path="/politica-privacidade" element={<PrivacyPolicy />} />
          {/* ADD ALL CUSTOM ROUTES ABOVE THE CATCH-ALL "*" ROUTE */}
          <Route path="*" element={<NotFound />} />
        </Routes>
        <CookieConsent />
      </BrowserRouter>
    </TooltipProvider>
  </QueryClientProvider>
);

export default App;
