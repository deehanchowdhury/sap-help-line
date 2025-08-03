<?php
session_start();
include 'includes/config.php';
include 'includes/header.php';
?>

<!-- Hero Section with SAP Theme -->
<section class="hero-section">
    <div class="hero-background">
        <div class="sap-grid"></div>
        <div class="floating-elements">
            <div class="sap-icon">📊</div>
            <div class="sap-icon">🔧</div>
            <div class="sap-icon">💼</div>
            <div class="sap-icon">📈</div>
        </div>
    </div>
    <div class="hero-content">
        <div class="hero-badge">
            <span class="badge-sap">SAP CERTIFIED</span>
            <span class="badge-trusted">TRUSTED BY 500+ ENTERPRISES</span>
        </div>
        <h1 class="hero-title">
            Professional SAP Issue Resolution Platform
        </h1>
        <p class="hero-subtitle">
            Connect with certified SAP consultants and get your business-critical issues resolved with guaranteed SLAs and expert support.
        </p>
        <div class="hero-metrics">
            <div class="metric">
                <div class="metric-number">98%</div>
                <div class="metric-label">Resolution Rate</div>
            </div>
            <div class="metric">
                <div class="metric-number">2h</div>
                <div class="metric-label">Avg Response Time</div>
            </div>
            <div class="metric">
                <div class="metric-number">500+</div>
                <div class="metric-label">Expert Consultants</div>
            </div>
        </div>
        <div class="hero-actions">
            <?php if(!isset($_SESSION['user_id'])): ?>
                <a href="pages/register.php" class="btn btn-primary btn-lg">
                    🚀 Get Started Free
                </a>
                <a href="pages/register.php?role=CONSULTANT" class="btn btn-secondary btn-lg">
                    💼 Become a Consultant
                </a>
            <?php else: ?>
                <a href="pages/user_dashboard.php" class="btn btn-primary btn-lg">
                    Go to Dashboard
                </a>
            <?php endif; ?>
        </div>
        <div class="hero-trust">
            <div class="trust-item">
                <span class="trust-icon">🔒</span>
                <span>Secure Payments</span>
            </div>
            <div class="trust-item">
                <span class="trust-icon">⭐</span>
                <span>Expert Verified</span>
            </div>
            <div class="trust-item">
                <span class="trust-icon">🛡️</span>
                <span>Money Back Guarantee</span>
            </div>
        </div>
    </div>
</section>

<!-- Problem Solution Section -->
<section class="problem-solution">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">SAP Issues Resolved, Business Accelerated</h2>
            <p class="section-subtitle">Stop letting SAP problems slow down your business. Get expert solutions when you need them most.</p>
        </div>
        
        <div class="problem-grid">
            <div class="problem-card">
                <div class="problem-icon">⚠️</div>
                <h3>The Problem</h3>
                <ul class="problem-list">
                    <li>SAP system downtime affecting operations</li>
                    <li>Lack of in-house expertise for complex modules</li>
                    <li>Delayed issue resolution impacting business</li>
                    <li>High consulting costs with uncertain outcomes</li>
                    <li>Difficulty finding qualified SAP professionals</li>
                </ul>
            </div>
            
            <div class="solution-arrow">
                <div class="arrow-content">
                    <span>Transform</span>
                    <div class="arrow-icon">→</div>
                </div>
            </div>
            
            <div class="solution-card">
                <div class="solution-icon">✅</div>
                <h3>Our Solution</h3>
                <ul class="solution-list">
                    <li>Instant access to 500+ certified SAP consultants</li>
                    <li>Guaranteed response times based on your plan</li>
                    <li>50% upfront payment, 50% after resolution</li>
                    <li>Transparent pricing with no hidden fees</li>
                    <li>24/7 support for premium users</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- User Plans Section -->
<section class="user-plans-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Choose Your Support Level</h2>
            <p class="section-subtitle">Select the plan that best fits your business needs and budget</p>
        </div>
        
        <div class="plans-container">
            <div class="plan-card popular">
                <div class="plan-header">
                    <div class="plan-badge">MOST POPULAR</div>
                    <h3 class="plan-name">Free User</h3>
                    <div class="plan-price">$0<span>/month</span></div>
                </div>
                <div class="plan-features">
                    <div class="feature">
                        <span class="feature-icon">✓</span>
                        <span>Basic issue posting</span>
                    </div>
                    <div class="feature">
                        <span class="feature-icon">✓</span>
                        <span>Standard response time (24-48h)</span>
                    </div>
                    <div class="feature">
                        <span class="feature-icon">✓</span>
                        <span>Community support</span>
                    </div>
                    <div class="feature">
                        <span class="feature-icon">✓</span>
                        <span>Access to newbie consultants</span>
                    </div>
                    <div class="feature disabled">
                        <span class="feature-icon">✗</span>
                        <span>Priority support</span>
                    </div>
                    <div class="feature disabled">
                        <span class="feature-icon">✗</span>
                        <span>Deadline setting</span>
                    </div>
                </div>
                <div class="plan-priority">
                    <span class="priority-badge priority-low">LOW PRIORITY</span>
                </div>
                <a href="pages/register.php?plan=free" class="btn btn-outline btn-lg">Get Started Free</a>
            </div>
            
            <div class="plan-card featured">
                <div class="plan-header">
                    <div class="plan-badge">BEST VALUE</div>
                    <h3 class="plan-name">Pro User</h3>
                    <div class="plan-price">$29<span>/month</span></div>
                </div>
                <div class="plan-features">
                    <div class="feature">
                        <span class="feature-icon">✓</span>
                        <span>Priority issue posting</span>
                    </div>
                    <div class="feature">
                        <span class="feature-icon">✓</span>
                        <span>Fast response time (12-24h)</span>
                    </div>
                    <div class="feature">
                        <span class="feature-icon">✓</span>
                        <span>Access to expert consultants</span>
                    </div>
                    <div class="feature">
                        <span class="feature-icon">✓</span>
                        <span>Basic analytics dashboard</span>
                    </div>
                    <div class="feature">
                        <span class="feature-icon">✓</span>
                        <span>Priority assignment</span>
                    </div>
                    <div class="feature disabled">
                        <span class="feature-icon">✗</span>
                        <span>Deadline setting</span>
                    </div>
                </div>
                <div class="plan-priority">
                    <span class="priority-badge priority-medium">MEDIUM PRIORITY</span>
                </div>
                <a href="pages/register.php?plan=pro" class="btn btn-primary btn-lg">Start Pro Trial</a>
            </div>
            
            <div class="plan-card premium">
                <div class="plan-header">
                    <div class="plan-badge">ENTERPRISE</div>
                    <h3 class="plan-name">Premium User</h3>
                    <div class="plan-price">$99<span>/month</span></div>
                </div>
                <div class="plan-features">
                    <div class="feature">
                        <span class="feature-icon">✓</span>
                        <span>24/7 priority support</span>
                    </div>
                    <div class="feature">
                        <span class="feature-icon">✓</span>
                        <span>Instant response time (1-4h)</span>
                    </div>
                    <div class="feature">
                        <span class="feature-icon">✓</span>
                        <span>Admin panel direct support</span>
                    </div>
                    <div class="feature">
                        <span class="feature-icon">✓</span>
                        <span>Advanced analytics & reporting</span>
                    </div>
                    <div class="feature">
                        <span class="feature-icon">✓</span>
                        <span>Set deadlines (+5% cost option)</span>
                    </div>
                    <div class="feature">
                        <span class="feature-icon">✓</span>
                        <span>Dedicated account manager</span>
                    </div>
                </div>
                <div class="plan-priority">
                    <span class="priority-badge priority-high">HIGH PRIORITY</span>
                </div>
                <a href="pages/register.php?plan=premium" class="btn btn-premium btn-lg">Go Premium</a>
            </div>
        </div>
        
        <div class="plan-comparison">
            <h3>Still deciding? Compare all plans</h3>
            <a href="pages/plans-comparison.php" class="btn btn-secondary">View Detailed Comparison</a>
        </div>
    </div>
</section>

<!-- Consultant Section -->
<section class="consultant-section">
    <div class="container">
        <div class="consultant-content">
            <div class="consultant-info">
                <div class="section-header">
                    <h2 class="section-title">Join Our Expert Consultant Network</h2>
                    <p class="section-subtitle">Monetize your SAP expertise and help businesses worldwide</p>
                </div>
                
                <div class="consultant-benefits">
                    <div class="benefit-item">
                        <div class="benefit-icon">💰</div>
                        <div class="benefit-content">
                            <h4>Earn Competitive Rates</h4>
                            <p>Get paid based on your expertise level - up to 80% of project value</p>
                        </div>
                    </div>
                    
                    <div class="benefit-item">
                        <div class="benefit-icon">📈</div>
                        <div class="benefit-content">
                            <h4>Build Your Reputation</h4>
                            <p>Gain recognition and build your professional profile in the SAP community</p>
                        </div>
                    </div>
                    
                    <div class="benefit-item">
                        <div class="benefit-icon">🌍</div>
                        <div class="benefit-content">
                            <h4>Global Opportunities</h4>
                            <p>Work with clients from around the world on diverse SAP projects</p>
                        </div>
                    </div>
                    
                    <div class="benefit-item">
                        <div class="benefit-icon">⏰</div>
                        <div class="benefit-content">
                            <h4>Flexible Schedule</h4>
                            <p>Choose projects that fit your schedule and expertise</p>
                        </div>
                    </div>
                </div>
                
                <div class="expertise-levels">
                    <h3>Expertise Levels & Payment Structure</h3>
                    <div class="expertise-grid">
                        <div class="expertise-card">
                            <div class="expertise-level">Newbie</div>
                            <div class="expertise-payment">20% Share</div>
                            <div class="expertise-requirements">
                                <p>0-2 years experience</p>
                                <p>0-20 problems solved</p>
                                <p>Easy difficulty focus</p>
                            </div>
                        </div>
                        
                        <div class="expertise-card">
                            <div class="expertise-level">Medium</div>
                            <div class="expertise-payment">60% Share</div>
                            <div class="expertise-requirements">
                                <p>2-5 years experience</p>
                                <p>20-50 problems solved</p>
                                <p>Medium difficulty focus</p>
                            </div>
                        </div>
                        
                        <div class="expertise-card">
                            <div class="expertise-level">Expert</div>
                            <div class="expertise-payment">80% Share</div>
                            <div class="expertise-requirements">
                                <p>5+ years experience</p>
                                <p>50+ problems solved</p>
                                <p>High difficulty specialist</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="consultant-cta">
                    <a href="pages/register.php?role=CONSULTANT" class="btn btn-primary btn-lg">
                        🚀 Become a Consultant Today
                    </a>
                    <p class="consultant-note">Join 500+ SAP experts already on our platform</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="how-it-works">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">How It Works</h2>
            <p class="section-subtitle">Get your SAP issues resolved in 5 simple steps</p>
        </div>
        
        <div class="process-flow">
            <div class="process-step">
                <div class="step-number">1</div>
                <div class="step-icon">📝</div>
                <h3>Post Your Issue</h3>
                <p>Describe your SAP issue with detailed requirements and pay 50% upfront</p>
            </div>
            
            <div class="process-arrow">→</div>
            
            <div class="process-step">
                <div class="step-number">2</div>
                <div class="step-icon">👨‍💼</div>
                <h3>Expert Assignment</h3>
                <p>Qualified consultants take your issue based on expertise and priority</p>
            </div>
            
            <div class="process-arrow">→</div>
            
            <div class="process-step">
                <div class="step-number">3</div>
                <div class="step-icon">💬</div>
                <h3>Collaborate</h3>
                <p>Consultant clarifies requirements and develops solution approach</p>
            </div>
            
            <div class="process-arrow">→</div>
            
            <div class="process-step">
                <div class="step-number">4</div>
                <div class="step-icon">✅</div>
                <h3>Resolution</h3>
                <p>Issue resolved with professional solution and documentation</p>
            </div>
            
            <div class="process-arrow">→</div>
            
            <div class="process-step">
                <div class="step-number">5</div>
                <div class="step-icon">💰</div>
                <h3>Complete Payment</h3>
                <p>Pay remaining 50% after confirming successful resolution</p>
            </div>
        </div>
    </div>
</section>

<!-- Trust Indicators Section -->
<section class="trust-section">
    <div class="container">
        <div class="trust-content">
            <div class="trust-stats">
                <div class="stat-item">
                    <div class="stat-number">10,000+</div>
                    <div class="stat-label">Issues Resolved</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">$2M+</div>
                    <div class="stat-label">Paid to Consultants</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">98%</div>
                    <div class="stat-label">Customer Satisfaction</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Support Available</div>
                </div>
            </div>
            
            <div class="trust-logos">
                <h3>Trusted by Leading Enterprises</h3>
                <div class="logo-grid">
                    <div class="logo-placeholder">SAP</div>
                    <div class="logo-placeholder">Fortune 500</div>
                    <div class="logo-placeholder">Global 2000</div>
                    <div class="logo-placeholder">Enterprise</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">What Our Users Say</h2>
            <p class="section-subtitle">Real feedback from businesses and consultants</p>
        </div>
        
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div class="testimonial-content">
                    <div class="testimonial-rating">⭐⭐⭐⭐⭐</div>
                    <p class="testimonial-text">
                        "This platform saved our business! We had a critical SAP MM issue that was costing us $50k per day. The platform connected us with an expert who resolved it in 4 hours. Worth every penny!"
                    </p>
                </div>
                <div class="testimonial-author">
                    <div class="author-avatar">👔</div>
                    <div class="author-info">
                        <div class="author-name">Sarah Johnson</div>
                        <div class="author-title">CFO, Manufacturing Corp</div>
                    </div>
                </div>
            </div>
            
            <div class="testimonial-card">
                <div class="testimonial-content">
                    <div class="testimonial-rating">⭐⭐⭐⭐⭐</div>
                    <p class="testimonial-text">
                        "As an SAP consultant with 15 years experience, this platform has tripled my income. I get to work on challenging projects and get paid fairly for my expertise."
                    </p>
                </div>
                <div class="testimonial-author">
                    <div class="author-avatar">👨‍💼</div>
                    <div class="author-info">
                        <div class="author-name">Michael Chen</div>
                        <div class="author-title">SAP Consultant</div>
                    </div>
                </div>
            </div>
            
            <div class="testimonial-card">
                <div class="testimonial-content">
                    <div class="testimonial-rating">⭐⭐⭐⭐⭐</div>
                    <p class="testimonial-text">
                        "The premium plan is a game-changer. Having direct access to the admin panel and 24/7 support has prevented countless potential disasters in our SAP system."
                    </p>
                </div>
                <div class="testimonial-author">
                    <div class="author-avatar">👩‍💼</div>
                    <div class="author-info">
                        <div class="author-name">Emily Rodriguez</div>
                        <div class="author-title">IT Director, Retail Chain</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Final CTA Section -->
<section class="final-cta">
    <div class="container">
        <div class="cta-content">
            <h2 class="cta-title">Ready to Transform Your SAP Experience?</h2>
            <p class="cta-subtitle">
                Join thousands of businesses and consultants who are already benefiting from our platform
            </p>
            <div class="cta-buttons">
                <a href="pages/register.php" class="btn btn-primary btn-lg">
                    🚀 Get Started Free
                </a>
                <a href="pages/register.php?role=CONSULTANT" class="btn btn-secondary btn-lg">
                    💼 Become a Consultant
                </a>
            </div>
            <div class="cta-guarantee">
                <div class="guarantee-icon">🛡️</div>
                <div class="guarantee-text">
                    <strong>30-Day Money Back Guarantee</strong>
                    <p>If you're not satisfied with our service, we'll refund your first month's subscription</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>