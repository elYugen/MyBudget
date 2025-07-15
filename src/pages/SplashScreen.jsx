import { useState, useEffect, useRef } from 'react';
import { useNavigate } from 'react-router-dom';
import "../assets/css/SplashScreen.css";
import axiosInstance from '../config/axios';

function SplashScreen() {
  const navigate = useNavigate();
  const [isLoading, setIsLoading] = useState(true);
  const [currentSlide, setCurrentSlide] = useState(0);
  const carouselRef = useRef(null);
  const touchStartX = useRef(0);

  const slides = [
    {
      title: "Bienvenue sur AppBudget",
      description: "Gérez votre budget simplement et efficacement",
      icon: "💰"
    },
    {
      title: "Ajoutez vos comptes",
      description: "Créez et gérez plusieurs comptes bancaires en un seul endroit",
      icon: "🏦"
    },
    {
      title: "Suivez vos opérations",
      description: "Enregistrez et catégorisez toutes vos transactions",
      icon: "📊"
    }
  ];

  useEffect(() => {
    const checkAuth = async () => {
      try {
        const response = await axiosInstance.get('/auth/user');
        if (response.data) {
          navigate('/home');
        }
      } catch (error) {
        console.error('Erreur de vérification:', error);
      } finally {
        setIsLoading(false);
      }
    };

    checkAuth();
  }, [navigate]);

  const handleWheel = (e) => {
    if (e.deltaY > 0) {
      setCurrentSlide((prev) => (prev + 1) % slides.length);
    } else {
      setCurrentSlide((prev) => (prev - 1 + slides.length) % slides.length);
    }
  };

  const handleTouchStart = (e) => {
    touchStartX.current = e.touches[0].clientX;
  };

  const handleTouchEnd = (e) => {
    const touchEndX = e.changedTouches[0].clientX;
    const diff = touchStartX.current - touchEndX;

    if (Math.abs(diff) > 50) { // Seuil minimum pour le swipe
      if (diff > 0) {
        setCurrentSlide((prev) => (prev + 1) % slides.length);
      } else {
        setCurrentSlide((prev) => (prev - 1 + slides.length) % slides.length);
      }
    }
  };

  if (isLoading) {
    return (
      <div className="loading-container">
        <div className="loader"></div>
      </div>
    );
  }

  return (
    <div className="splash-container">
      <div className="animated-background"></div>
      <div className="splash-content">
        <div 
          className="carousel"
          ref={carouselRef}
          onWheel={handleWheel}
          onTouchStart={handleTouchStart}
          onTouchEnd={handleTouchEnd}
        >
          <div 
            className="carousel-content"
            style={{ transform: `translateX(-${currentSlide * 100}%)` }}
          >
            {slides.map((slide, index) => (
              <div key={index} className="slide">
                <div className="slide-icon">{slide.icon}</div>
                <h1>{slide.title}</h1>
                <p>{slide.description}</p>
                {index === slides.length - 1 && (
                  <div className="button-container">
                    <button onClick={() => navigate('/login')} className="btn btn-primary">
                      Commencer
                    </button>
                  </div>
                )}
              </div>
            ))}
          </div>
        </div>
        
        <div className="carousel-dots">
          {slides.map((_, index) => (
            <span 
              key={index} 
              className={`dot ${currentSlide === index ? 'active' : ''}`}
              onClick={() => setCurrentSlide(index)}
            ></span>
          ))}
        </div>
      </div>
    </div>
  );
}

export default SplashScreen;