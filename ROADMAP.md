# 🚀 Roadmap Pengembangan Portal IDP

> Dokumen ini menjelaskan rencana pengembangan Portal IDP untuk meningkatkan user experience, efektivitas program pengembangan talent, dan fleksibilitas sistem.

**Last Updated**: Juli 2026  
**Version**: 1.0  
**Status**: 🟢 Active Planning

## 🎯 Overview

Portal IDP saat ini telah berhasil mengimplementasikan sistem manajemen pengembangan talent dengan 6 role yang berbeda. Roadmap ini fokus pada 4 area pengembangan utama yang bertujuan untuk:

- ✅ Meningkatkan **konsistensi** dokumentasi IDP melalui sistem reminder
- ✅ Memperbaiki **komunikasi** antara mentor dan talent dengan feedback terstruktur
- ✅ Memberikan **fleksibilitas karir** melalui cross-functional development
- ✅ Melengkapi assessment dengan **hard skill** yang spesifik dan terukur

---

## 🔧 Development Areas

### 1. 🔔 Sistem Notifikasi Pengingat

**Tujuan**: Meningkatkan completion rate dan konsistensi dokumentasi IDP

#### Fitur Utama

**A. Session Expiry Reminders**
- Multi-level reminders: 30d, 14d, 7d, 3d, 1d sebelum deadline
- Notifikasi ke Talent, Mentor, Atasan, PDC Admin
- Visual countdown di dashboard
- Konfigurasi interval per company/position

**B. Monthly Logbook Reminders** ⭐
- **Target**: Minimal 1 logbook per bulan
- **Schedule**:
  - Tanggal 20: First reminder
  - Tanggal 25: Second reminder  
  - Tanggal 28: Final reminder (urgent)
  - Tanggal 1-5 (bulan berikutnya): Overdue notification

**C. Compliance Dashboard**
- Monthly submission calendar/heatmap
- Compliance rate tracking per talent/department/company
- Submission streak tracking
- Automated compliance reports

**D. Gamification** (Optional)
- Achievement badges (Consistent Performer, Early Bird, Perfect Score)
- Leaderboard per department
- Streak counter visualization

#### Implementation Highlights

**Database**:
```sql
-- New tracking table
logbook_monthly_tracking (user_id, year, month, submission_count, status, reminder_sent_at)
```

**Scheduled Jobs**: 8 cron tasks untuk reminder automation

**Expected Impact**:
- 📈 Compliance rate: 90%
- 📉 Session expired tanpa hasil: -50%
- 📊 Overdue submissions: -60%

---

### 2. 💬 Enhanced Feedback System

**Tujuan**: Meningkatkan kualitas dokumentasi IDP melalui feedback terstruktur

#### Fitur Utama

**A. Mandatory Rejection Feedback**
- Kategori rejection: Incomplete Documentation, Wrong Format, Insufficient Evidence, Not Relevant, Quality Below Standard
- Detailed feedback text area
- Improvement suggestions
- Expected evidence checklist

**B. Revision Tracking**
- Complete revision history
- Status progression: Rejected → Under Revision → Resubmitted → Approved
- Version control untuk setiap submission

**C. Analytics Dashboard**
- Rejection rate per talent (identify struggling talents)
- Rejection rate per mentor (consistency check)
- Common rejection reasons analysis
- Average revision cycle time
- Quality improvement trends

**D. Quality Tools**
- Best practice library (approved logbook examples)
- Standardized acceptance criteria
- Training recommendations based on rejection patterns

#### Expected Impact
- 📝 100% rejection documented dengan feedback
- ⏱️ Revision cycle time: -40%
- ✅ First-time approval rate: +30%
- 📈 Documentation quality score: +25%

---

### 3. 🏢 Cross-Department & Cross-Position

**Tujuan**: Enable talent mobility untuk career flexibility dan internal mobility

#### Fitur Utama

**A. Enhanced Master Data Management**
- Edit department/position features untuk PDC Admin
- Department & position hierarchy
- Transfer history tracking
- Impact analysis sebelum changes

**B. Cross-Functional Development Plans**
- **Vertical Move**: Staff → Supervisor (same dept)
- **Lateral Move**: Finance Staff → HR Staff (same level, different function)
- **Diagonal Move**: Sales Supervisor → Marketing Manager (cross-function + level)
- **Rotation**: Temporary assignment di department lain

**C. Dual Approval Workflow**
- Approval dari source department atasan
- Approval dari target department atasan
- Competency gap analysis lintas fungsi
- Cross-department mentor assignment

**D. Transfer Management**
- Bulk edit untuk organizational restructuring
- Temporary assignment (secondment) dengan end date
- Complete audit trail
- Rollback capability

#### Expected Impact
- 🚀 Internal mobility rate: +30%
- 👥 Cross-department moves success rate: 80%
- 📈 Talent retention: +20%
- ⏱️ Time-to-fill key positions: -25%

---

### 4. 🎯 Hard Skill Assessment

**Tujuan**: Comprehensive assessment dengan technical skills yang terukur

#### Fitur Utama

**A. Hard Skill Master Data**
- Skill categories: Technical, Functional, Tools & Technology, Certifications
- Proficiency levels: Basic (1) → Intermediate (2) → Advanced (3) → Expert (4)
- Department-specific skill catalog
- Position-specific requirements

**B. Department-Specific Skills Examples**

| Department | Key Hard Skills |
|------------|----------------|
| **IT/Engineering** | Python, Java, Laravel, Docker, PostgreSQL, AWS, CI/CD |
| **Finance** | SAP, Excel Advanced, PSAK, IFRS, Financial Modeling, CPA |
| **HR** | HRIS (Workday, SAP), ATS, Payroll Systems, Labor Law |
| **Operations** | ERP, Lean Six Sigma, ISO Standards, WMS, TMS |
| **Sales & Marketing** | Salesforce, Google Analytics, SEO/SEM, CRM |

**C. Assessment Methods**
- Self-assessment by talent
- Validation by atasan
- Evidence-based (certificates, portfolios, projects)
- Skill tests/quizzes (optional)
- Peer endorsements (optional)

**D. Skill Gap Analysis**
- Visual skill matrix heatmap (current vs required)
- Gap scoring per skill
- Priority ranking untuk critical gaps
- Learning path recommendations
- Integration dengan IDP untuk skill development

**E. Evidence & Validation**
- Upload certificates/credentials
- Link to portfolio/projects
- Certification expiry tracking
- Renewal reminders
- Digital badge integration

**F. Analytics & Reporting**
- Skill inventory per department/position
- Skill gap heatmap across organization
- Training needs analysis
- Succession planning based on skill readiness
- ROI analysis: training investment vs skill improvement

## 📊 Impact Matrix

| Feature | Talent | Mentor | Atasan | PDC Admin | Business Impact |
|---------|--------|--------|--------|-----------|-----------------|
| **Notifikasi Pengingat** | ⭐⭐⭐ | ⭐⭐ | ⭐⭐ | ⭐⭐⭐ | Konsistensi dokumentasi +90% |
| **Feedback System** | ⭐⭐⭐ | ⭐⭐⭐ | ⭐⭐ | ⭐⭐ | Kualitas logbook +25% |
| **Cross-Dept/Position** | ⭐⭐⭐ | ⭐⭐ | ⭐⭐⭐ | ⭐⭐⭐ | Internal mobility +30% |
| **Hard Skill Assessment** | ⭐⭐⭐ | ⭐⭐⭐ | ⭐⭐⭐ | ⭐⭐⭐ | Training ROI +40% |

**Legend**: ⭐ Low | ⭐⭐ Medium | ⭐⭐⭐ High

---

### Database Impact

**New Tables**: 5
- `logbook_monthly_tracking`
- `idp_activity_revisions`
- `user_transfer_history`
- `hard_skill_categories`, `hard_skills`, `user_hard_skills`, dll (8 tables)

**Modified Tables**: 8
- `development_sessions`, `idp_activity`, `promotion_plan`, dll

## 🔒 Risk Considerations

### Technical Risks

**High Priority**:
- ⚠️ Email volume spike (monthly reminders ke semua talent)
  - **Mitigation**: Queue system + rate limiting
  
- ⚠️ Performance impact (analytics queries)
  - **Mitigation**: Proper indexing + caching strategy

**Medium Priority**:
- ⚠️ Data migration complexity (Point 3)
  - **Mitigation**: Staging environment testing + rollback plan

- ⚠️ Hard skill catalog maintenance overhead
  - **Mitigation**: Clear ownership + periodic review process

### Business Risks

- 📊 User adoption resistance
  - **Mitigation**: Change management + training + documentation

- 💰 Budget constraints
  - **Mitigation**: Phased approach + MVP per phase

---

## 🤝 Kontribusi & Feedback

Roadmap ini bersifat dinamis dan akan di-update berdasarkan:
- User feedback dan actual usage patterns
- Business priority changes
- Technical feasibility dan constraints

