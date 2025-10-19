# Versioning Guide

Complete guide for versioning, branching, and tagging the Symfony Skeleton project.

---

## Table of Contents

1. [Quick Start](#quick-start)
2. [Symfony Versions Support](#symfony-versions-support)
3. [Branch Strategy](#branch-strategy)
4. [Version Numbering](#version-numbering)
5. [Setup Instructions](#setup-instructions)
6. [Creating Tags](#creating-tags)
7. [GitHub Actions Workflows](#github-actions-workflows)
8. [Maintenance & Workflows](#maintenance--workflows)
9. [Best Practices](#best-practices)
10. [FAQ](#faq)

---

## Quick Start

### 🎯 Strategy Overview

**Branch per Symfony version + Tags for skeleton releases**

- One branch per Symfony version (`6.4`, `7.3`, `7.4`)
- Tags are skeleton releases (`6.4.0`, `6.4.1`), not Symfony patch versions
- Tag when YOU make improvements, not every Symfony patch
- Users clone branches, get updates with `git pull`

### 📖 For Users (Cloning)

```bash
# Clone Symfony 6.4 LTS
git clone --branch 6.4 https://github.com/neuralglitch/skeleton.git myproject

# Clone Symfony 7.4 LTS (recommended)
git clone --branch 7.4 https://github.com/neuralglitch/skeleton.git myproject

# Clone Symfony 7.3 (current stable)
git clone --branch 7.3 https://github.com/neuralglitch/skeleton.git myproject
```

**What you get:**
- Latest skeleton code
- Symfony version from that branch
- All bug fixes and improvements
- Can `git pull` to get updates!

### 🔧 For Maintainers

**Branches:**
- `6.4` - Symfony 6.4 LTS (until Nov 2027)
- `7.3` - Symfony 7.3 (until Jan 2026)
- `7.4` - Symfony 7.4 LTS (until Nov 2029)
- `main` - Development

**Tags (on each branch):**
- `6.4.0` - First release
- `6.4.1` - After making improvements
- `6.4.2` - After more improvements

**When to tag:**
- ✅ When YOU make skeleton improvements
- ✅ Bug fixes, features, significant updates
- ❌ NOT for every Symfony patch update

---

## Symfony Versions Support

### 📊 Currently Supported Versions

| Symfony | Branch | Status | Released | EOL | Priority |
|---------|--------|--------|----------|-----|----------|
| **6.4 LTS** | `6.4` | ✅ Active | Nov 2023 | **Nov 2027** | High ⭐ |
| **7.3** | `7.3` | ✅ Active | May 2025 | **Jan 2026** | Medium |
| **7.4 LTS** | `7.4` | ✅ Active | Nov 2025 | **Nov 2029** | High ⭐ |

**LTS** = Long Term Support (48 months)  
**Standard** = Regular release (8 months bug fixes, 14 months security fixes)

### 🎯 Recommended Versions

**For Production:**
- **Now:** Use `6.4` (Symfony 6.4 LTS, 2 years support left) or `7.4` (Symfony 7.4 LTS, 4 years support)
- **Recommended:** Use `7.4` (Symfony 7.4 LTS, newest LTS)

**For New Development:**
- **Recommended:** Use `7.3` (current stable) or `7.4` (latest LTS)
- **Alternative:** Use `6.4` (older LTS)

**For Legacy Projects (PHP 8.1):**
- Use `6.4` (Symfony 6.4 supports PHP 8.1)

### 📅 Maintenance Schedule

#### Now (October 2025)

**Active branches:**
- `6.4` (Symfony 6.4 LTS)
- `7.3` (Symfony 7.3 stable, EOL Jan 2026)
- `7.4` (Symfony 7.4 LTS, released Nov 2025)

**Status:**
- ✅ Symfony 7.4 LTS released (November 2025)
- ✅ All branches created and maintained
- ⚠️ Symfony 7.3 EOL approaching (January 2026)

#### Upcoming (2026+)

**January 2026:**
- Symfony 7.3 reaches EOL
- Archive `7.3` branch (read-only)
- Focus on LTS branches only

**Active branches (2026-2027):**
- `6.4` (until Nov 2027)
- `7.4` (until Nov 2029)

**Strategy:**
- Backport critical fixes to both LTS branches
- Focus development on latest LTS (7.4)
- Prepare for Symfony 8.4 LTS (expected Nov 2027)

### 🔄 Upgrade Paths

#### From Symfony 6.4 → 7.4

```bash
# Backup first!

# Update composer.json
composer require "symfony/framework-bundle:7.4.*" --no-update
composer update symfony/*

# Test thoroughly
bin/phpunit
vendor/bin/phpstan analyse

# Check PHP 8.2 compatibility
# Update deprecated features
```

#### From Symfony 7.3 → 7.4

```bash
# Should be straightforward
composer require "symfony/framework-bundle:7.4.*" --no-update
composer update symfony/*
```

---

## Branch Strategy

### 🌳 Branch Structure

```
6.4 (Symfony 6.4 LTS)
  ├─ Tags: 6.4.0, 6.4.1, 6.4.2, ...
  ├─ Includes: Symfony 6.4.x (currently 6.4.26)
  └─ Maintained until: November 2027 (security fixes)

7.3 (Symfony 7.3)
  ├─ Tags: 7.3.0, 7.3.1, 7.3.2, ...
  ├─ Includes: Symfony 7.3.x
  └─ Maintained until: January 2026

7.4 (Symfony 7.4 LTS)
  ├─ Tags: 7.4.0, 7.4.1, 7.4.2, ...
  ├─ Includes: Symfony 7.4.x
  └─ Maintained until: November 2029 (security fixes)

main (latest/development)
  ├─ Always latest Symfony
  └─ Development happens here
```

### Branch Naming Convention

- `X.Y` - Symfony X.Y branch (e.g., `6.4`, `7.3`)
- `main` - Development branch (latest Symfony)

### When to Create New Branches

**Create new branch when:**
- New Symfony LTS is released (6.4, 7.4, 8.4, etc.)
- New Symfony minor version needs long-term support
- Different PHP version requirements (e.g., 8.1 vs 8.2)

**Don't create branches for:**
- Symfony patch versions (6.4.26, 6.4.27, etc.)
- Skeleton improvements

### Branch Maintenance

#### Active Branches (Maintain These)

**`6.4` - Symfony 6.4 LTS ⭐**
- Support until: November 2027 (security fixes)
- PHP: 8.1+
- Status: Production-ready
- Priority: HIGH

**`7.3` - Symfony 7.3**
- Support until: January 2026
- PHP: 8.2+
- Status: Active, EOL approaching
- Priority: MEDIUM (archive in Jan 2026)

**`7.4` - Symfony 7.4 LTS ⭐**
- Support until: November 2029 (security fixes)
- PHP: 8.2+
- Status: Active (released Nov 2025)
- Priority: HIGH

#### Development Branch

**`main`**
- Symfony: Latest (currently tracking 7.4 LTS)
- Purpose: Development, testing, new features
- Status: Unstable

### Backporting Policy

**Critical Security Fixes:**
- Backport to: All active LTS branches
- Timeline: Immediate

**Bug Fixes:**
- Backport to: All LTS branches
- Timeline: As needed

**Features:**
- Add to: Latest LTS only
- No backporting to older versions

---

## Version Numbering

### Format

```
SYMFONY_MAJOR.SYMFONY_MINOR.SKELETON_PATCH
```

**Components:**
- **MAJOR.MINOR** - Matches Symfony version (6.4, 7.0, 7.4)
- **PATCH** - Skeleton release number (0, 1, 2, ...)

**Examples:**
```
6.4.0 - First Symfony 6.4 skeleton release (includes Symfony 6.4.26)
6.4.1 - Docker improvements (includes Symfony 6.4.28)
6.4.2 - CI/CD features (includes Symfony 6.4.30)
```

### When to Increment PATCH

Create new tag when:
- ✅ Significant skeleton improvements
- ✅ New features added
- ✅ Bug fixes applied
- ✅ Documentation updates
- ✅ Docker/CI/CD improvements
- ✅ Important Symfony security updates

Don't create tag for:
- ❌ Routine Symfony patch updates
- ❌ Minor dependency bumps
- ❌ Work in progress
- ❌ Every `composer update`

**Rule of thumb:** Tag monthly or when you have meaningful changes.

### Tag Naming

**Full version tags:**
- `6.4.0`, `6.4.1`, `6.4.2` (on `6.4` branch)
- `7.0.0`, `7.0.1`, `7.0.2` (on `main-7.0` branch)
- `7.4.0`, `7.4.1`, `7.4.2` (on `7.4` branch)

**Short tags (optional):**
- `6.4`, `7.0`, `7.4` (points to latest patch for that version)

**Revision tags (for multiple updates on same Symfony):**
- `6.4.0-rev1`, `6.4.0-rev2` (if needed)

### Validation

Tags must match the Symfony MAJOR.MINOR from the branch:
- ✅ `6.4.0` on `6.4` branch → Valid
- ❌ `7.0.0` on `6.4` branch → Invalid

The `bin/tag-version` script enforces this automatically.

---

## Setup Instructions

### Prerequisites

- Git repository initialized
- Current code is Symfony 6.4 (adjust if different)
- Access to GitHub repository

### Step 1: Create Version Branches

#### 1a. Create `6.4` Branch (Symfony 6.4 LTS)

```bash
# Create branch from current main (assuming Symfony 6.4)
git checkout main
git checkout -b 6.4
git push -u origin 6.4
```

#### 1b. Create `7.3` Branch (Symfony 7.3)

```bash
# Start from main
git checkout main

# Create new branch
git checkout -b 7.3

# Upgrade to Symfony 7.3
composer require "symfony/framework-bundle:7.3.*" --no-update
composer update symfony/*

# Update code for Symfony 7 compatibility
# - Check deprecated features
# - Requires PHP 8.2+
# - Test thoroughly

git add composer.json composer.lock
git commit -m "Upgrade to Symfony 7.3"
git push -u origin 7.3
```

#### 1c. Create `7.4` Branch (Symfony 7.4 LTS)

```bash
# Symfony 7.4 LTS released November 2025
git checkout main

# Create new branch
git checkout -b 7.4

# Upgrade to Symfony 7.4
composer require "symfony/framework-bundle:7.4.*" --no-update
composer update symfony/*

# Test and commit
git add composer.json composer.lock
git commit -m "Upgrade to Symfony 7.4 LTS"
git push -u origin 7.4
```

### Step 2: Create Initial Tags

#### 2a. Tag Symfony 6.4 Branch

```bash
git checkout 6.4

# Check version
docker compose exec web php bin/detect-symfony-version

# Create tag
bin/tag-version 6.4.0
```

**Release notes:**
```
Initial Symfony 6.4 LTS skeleton release

- Docker environment with Apache and SSL
- AssetMapper for modern frontend development
- Bootstrap 5.3 with full SCSS customization
- Stimulus Bundle for reactive JavaScript
- Comprehensive CI/CD pipeline (6 workflows)
- PHPStan Level 6 static analysis
- PHPUnit 11.5 testing framework
- Symfony 6.4 LTS support until November 2027
```

```bash
git push origin 6.4.0
```

#### 2b. Tag Symfony 7.3 Branch

```bash
git checkout 7.3
bin/tag-version 7.3.0
```

**Release notes:**
```
Initial Symfony 7.3 skeleton release

- Upgraded to Symfony 7.3
- PHP 8.2+ support
- Current stable release
- Modern AssetMapper frontend
- Bootstrap 5.3 with SCSS customization
```

```bash
git push origin 7.3.0
```

#### 2c. Tag Symfony 7.4 Branch

```bash
git checkout 7.4
bin/tag-version 7.4.0
```

**Release notes:**
```
Initial Symfony 7.4 LTS skeleton release

- Upgraded to Symfony 7.4 LTS
- PHP 8.2+ support
- Long-term support until November 2028
- Production-ready starter kit
```

```bash
git push origin 7.4.0
```

### Step 3: Create Short Tags

```bash
# For Symfony 6.4 LTS
git checkout 6.4
git tag 6.4
git push origin 6.4

# For Symfony 7.3
git checkout 7.3
git tag 7.3
git push origin 7.3

# For Symfony 7.4 LTS
git checkout 7.4
git tag 7.4
git push origin 7.4
```

### Step 4: Set Default Branch

**On GitHub:**
1. Go to: Settings → Branches
2. Recommended default branch: `7.4` (latest LTS)
3. Alternative: `6.4` (older LTS, PHP 8.1 compatible)

### Step 5: Branch Protection

**Protect all version branches:**

1. Go to: Settings → Branches
2. Add branch protection rule
3. Branch pattern: `main-*`
4. Enable:
   - ✅ Require pull request reviews
   - ✅ Require status checks (CI/CD)
   - ✅ Require branches up to date
   - ✅ No bypassing

### Step 6: Test

```bash
# Test Symfony 6.4 LTS
cd /tmp
git clone --branch 6.4 https://github.com/neuralglitch/skeleton.git test-64
cd test-64
git describe --tags  # Should show: 6.4.0

# Test short tag
git clone --branch 6.4 https://github.com/neuralglitch/skeleton.git test-short
```

---

## Creating Tags

### Detection Tool

Always start by detecting the Symfony version:

```bash
docker compose exec web bin/detect-symfony-version
```

**Output example:**
```
✅ Detected Symfony version: 7.3.0
ℹ️  From: composer.lock (installed version)

ℹ️  Next skeleton version:
  • 7.3.1 - Next release (includes Symfony 7.3.0)
  • 7.3 - Branch/short tag (optional)

ℹ️  Version strategy:
  ✓ Branch: 7.3
  ✓ Tags: 7.3.0, 7.3.1, 7.3.2, etc.
  ✓ Tag when: Skeleton improvements, not every Symfony patch

ℹ️  To create a new skeleton release:
  bin/tag-version 7.3.1
```

### Method 1: Local Script (Recommended for Development)

```bash
# Checkout the branch
git checkout 7.3

# Check suggested version
docker compose exec web bin/detect-symfony-version

# Create tag
docker compose exec web bin/tag-version 7.3.1

# Push tag
git push origin 7.3.1

# Update short tag (optional)
git tag -f 7.3
git push -f origin 7.3
```

### Method 2: GitHub Actions Manual Workflow

1. Go to: **Actions** → **Manual Tag Creation**
2. Click **Run workflow**
3. Fill in:
   - **Tag version**: Leave empty (auto-detect) or specify
   - **Release notes**: Optional
   - **Create GitHub Release**: Check if desired
4. Click **Run workflow**

### Method 3: Manual Git Tagging

```bash
git tag -a 7.3.1 -m "Release version 7.3.1

- Docker improvements
- Updated CI/CD workflows
- Bug fixes"

git push origin 7.3.1
```

### Updating Short Tags

After creating a new release, update the short tag:

```bash
# Point short tag to latest release
git tag -f 7.3
git push -f origin 7.3
```

---

## GitHub Actions Workflows

This repository includes GitHub Actions workflows for automatic and manual tag creation aligned with Symfony versions.

### Overview

| Method | Use Case | Trigger |
|--------|----------|---------|
| **Auto-tag** | Symfony updates | Push to main with composer.lock changes |
| **Manual** | Custom tags, revisions | Manual GitHub Actions trigger |
| **Local script** | Development, testing | Command line: `bin/tag-version` |

### Auto-Tag Workflow

**File:** `.github/workflows/auto-tag.yml`

**Triggers:** Automatically when `composer.lock` changes on the `main` branch

```yaml
on:
  push:
    branches:
      - main
    paths:
      - 'composer.lock'
```

**What it does:**
1. Detects Symfony version from `composer.lock`
2. Checks if tag already exists
3. Creates annotated tag matching Symfony version
4. Pushes tag to repository
5. Creates GitHub Release

**Steps:**
1. Checkout with full history
2. Setup PHP 8.1
3. Detect Symfony version using `bin/detect-symfony-version`
4. Check if tag exists
5. Create annotated tag with commit message
6. Push tag
7. Create GitHub Release

**Tag Message Format:**
```
Release version 6.4.26

Symfony 6.4.26

Automated release created by GitHub Actions.

Commit: abc123...
[commit message]
```

**Example workflow:**
```bash
# Update Symfony
composer update symfony/*

# Commit and push
git add composer.lock
git commit -m "Update Symfony to 6.4.27"
git push origin main

# Workflow automatically creates tag 6.4.27 and GitHub Release
```

**When it runs:**
- ✅ After `composer update symfony/*`
- ✅ After merging Symfony upgrade PRs
- ✅ Any change to `composer.lock` that affects Symfony version

**When it skips:**
- ⏭️ Tag already exists for that version
- ⏭️ No changes to `composer.lock`

### Manual-Tag Workflow

**File:** `.github/workflows/manual-tag.yml`

**Triggers:** Manually via GitHub Actions UI

**What it does:**
1. Allows you to specify a custom tag version (or auto-detect)
2. Add custom release notes
3. Choose whether to create a GitHub Release
4. Validates tag format and Symfony alignment
5. Creates and pushes the tag

**Inputs:**
- `tag_version` (optional): Custom tag version
- `release_notes` (optional): Custom release notes
- `create_release` (boolean): Create GitHub Release

**Validations:**
- ✅ Tag format: `MAJOR.MINOR.PATCH` or `MAJOR.MINOR.PATCH-suffix`
- ✅ Tag doesn't already exist
- ⚠️ Warning if doesn't match Symfony version

**When to use:**
- When you want to tag without updating Symfony
- To create revision tags (e.g., `6.4.26-rev1`)
- When automatic workflow fails and you need manual control
- To create tags for specific commits

**How to use:**
1. Go to: `Actions` tab → `Manual Tag Creation` → `Run workflow`
2. Inputs:
   - **Tag version**: Leave empty to auto-detect, or specify (e.g., `6.4.26`)
   - **Release notes**: Optional custom notes
   - **Create GitHub Release**: Check to create release
3. Click **Run workflow**

**Example 1: Auto-detect Version**

*Scenario:* You want to tag current version as 6.4.26

1. Go to GitHub Actions
2. Select "Manual Tag Creation"
3. Click "Run workflow"
4. Leave tag version empty (auto-detects 6.4.26)
5. Add release notes (optional)
6. Check "Create GitHub Release"
7. Click "Run workflow"

**Example 2: Revision Tag**

*Scenario:* Multiple skeleton updates without Symfony change

1. Go to GitHub Actions
2. Select "Manual Tag Creation"
3. Enter tag: `6.4.26-rev1`
4. Add notes: "Updated Docker configuration"
5. Run workflow

### Configuration

**Required Permissions:**

Both workflows require:
```yaml
permissions:
  contents: write
```

This is already configured in the workflow files.

**Secrets:**

Uses built-in `GITHUB_TOKEN` - no additional secrets needed.

**Permissions Scope:**

Workflows have `contents: write` - can:
- ✅ Create tags
- ✅ Push tags
- ✅ Create releases

Cannot:
- ❌ Modify code
- ❌ Delete tags (without force)
- ❌ Change settings

### Workflow Troubleshooting

#### Workflow Fails: "Tag already exists"

**Cause:** Tag was already created

**Solutions:**
```bash
# Check existing tags
git tag -l "6.4.*"

# Delete if needed
git tag -d 6.4.26
git push origin :refs/tags/6.4.26

# Re-run workflow
```

#### Workflow Skipped

**Cause:** Only triggers on `composer.lock` changes

**Solution:**
- Use manual workflow for custom tags
- Or update composer.lock: `composer update`

#### Tag Doesn't Match Symfony

**Cause:** Manual tag specified doesn't align with Symfony version

**Solution:**
- Workflow will warn but continue
- Check suggested tag: `bin/detect-symfony-version`
- Use suggested version for consistency

#### GitHub Release Not Created

**Possible causes:**
1. Permission issue - check `contents: write` is set
2. `create-release` action deprecated - consider updating to `softprops/action-gh-release`
3. `GITHUB_TOKEN` missing (should be automatic)

**Fix deprecated action:**

Replace in both workflows:
```yaml
- name: Create GitHub Release
  uses: softprops/action-gh-release@v1
  with:
    tag_name: ${{ steps.tag.outputs.version }}
    name: Version ${{ steps.tag.outputs.version }}
    body: |
      [release notes content]
```

### Customization

#### Change Trigger Branch

Edit `.github/workflows/auto-tag.yml`:
```yaml
on:
  push:
    branches:
      - production  # Change from 'main'
```

#### Customize Release Notes Template

Edit the `body` section in both workflows:
```yaml
body: |
  ## Your Custom Template
  
  Symfony version: ${{ steps.detect.outputs.symfony_version }}
  
  [Your custom content]
```

#### Add Notification

Add a step to notify Slack/Discord/etc:
```yaml
- name: Notify Slack
  uses: slackapi/slack-github-action@v1
  with:
    payload: |
      {
        "text": "New tag created: ${{ steps.tag.outputs.version }}"
      }
```

### Disabling Auto-Tagging

If you prefer manual control only:

**Option 1:** Delete the auto-tag workflow
```bash
rm .github/workflows/auto-tag.yml
```

**Option 2:** Disable in GitHub Settings
- Go to: Settings → Actions → Disable workflow

**Option 3:** Comment out the trigger
```yaml
# on:
#   push:
#     branches:
#       - main
```

### Migration from Manual Tagging

If you were tagging manually:

1. **Enable workflows** - Workflows are ready to use
2. **Delete local script usage** - No need for `bin/tag-version` in CI
3. **Update documentation** - Point to GitHub Actions
4. **Test first tag** - Watch workflow run
5. **Monitor** - Check tags are created correctly

**Note:** `bin/tag-version` still useful for local development and testing!

---

## Maintenance & Workflows

### Daily Workflow

#### Updating Symfony Patches (No Tag)

```bash
git checkout 6.4

composer update symfony/*
git commit -am "Update Symfony to 6.4.30"
git push

# NO TAG NEEDED!
# Users get this with: git pull
```

#### Making Skeleton Improvements (Create Tag)

```bash
git checkout 6.4

# Make your changes
git commit -am "Improve Docker configuration"
git push

# Create release
bin/detect-symfony-version  # Shows: next version 6.4.1
bin/tag-version 6.4.1
git push origin 6.4.1

# Update short tag
git tag -f 6.4
git push -f origin 6.4
```

### Backporting Fixes

Fix discovered that needs backporting:

```bash
# Fix on main
git checkout main
git commit -m "Fix Docker port mapping"
git push

# Backport to 6.4
git checkout 6.4
git cherry-pick <commit-hash>
git push

# Backport to 7.4
git checkout 7.4
git cherry-pick <commit-hash>
git push

# Tag when ready
git checkout 6.4
bin/tag-version 6.4.2
git push origin 6.4.2
```

### Creating New Symfony Version Branch

When Symfony 8.0 is released (November 2025):

```bash
git checkout main
composer require "symfony/framework-bundle:8.0.*" --no-update
composer update symfony/*

# Update code for Symfony 8 compatibility
# Requires PHP 8.4+
# Test thoroughly

git checkout -b main-8.0
git push -u origin main-8.0

bin/tag-version 8.0.0
git push origin 8.0.0

git tag 8.0
git push origin 8.0
```

When Symfony 8.4 LTS is released (November 2027):

```bash
# Create LTS branch
git checkout -b main-8.4
composer require "symfony/framework-bundle:8.4.*" --no-update
composer update symfony/*

git push -u origin main-8.4
bin/tag-version 8.4.0
git push origin 8.4.0
```

### End of Life Process

When a Symfony version reaches EOL (e.g., Symfony 7.3 in January 2026):

```bash
# Make final security release
git checkout 7.3
# Apply any final security patches
git commit -am "Final security update"

# Tag as EOL
git tag 7.3.99-eol -m "End of life release"
git push origin 7.3.99-eol

# Archive branch (on GitHub)
# Settings → Branches → Archive 7.3

# Update README with EOL notice
```

---

## Best Practices

### ✅ DO

- Keep branches synchronized for common fixes
- Use `git cherry-pick` for backports
- Document branch strategy in README
- Update branch protection rules
- Test thoroughly before tagging
- Write clear release notes
- Tag monthly or for significant changes
- Focus on LTS branches
- Communicate EOL dates early

### ❌ DON'T

- Merge between version branches (cherry-pick instead)
- Create tags for every Symfony patch
- Delete old branches (archive instead)
- Force-push to protected branches
- Skip branch-specific testing
- Tag work in progress
- Ignore security updates

### 🎯 Tag Creation Guidelines

**Create tags for:**
- Significant skeleton improvements
- New features
- Major bug fixes
- Docker/CI/CD enhancements
- Documentation updates
- Important security updates

**Don't create tags for:**
- Every Symfony patch update
- Minor tweaks
- Dependency bumps
- Experimental features

### 📋 Release Notes Best Practices

**Good release notes:**
```
Release 6.4.2 - Docker and CI/CD Improvements

Features:
- Added Redis support to Docker Compose
- New GitHub Actions workflow for security scanning
- Improved SSL certificate generation

Bug Fixes:
- Fixed Docker port conflict issue #123
- Resolved asset compilation in production

Includes: Symfony 6.4.28
```

**Bad release notes:**
```
Update stuff
```

---

## FAQ

### Q: Why branch per Symfony version?

**A:** Multiple benefits:
- Easy to backport fixes
- Maintain different codebases (PHP requirements, etc.)
- Users get stable base to pull from
- Clear separation of versions

### Q: How do users know which branch to use?

**A:** README clearly states:
- `7.4` for Symfony 7.4 LTS (recommended, newest LTS)
- `6.4` for Symfony 6.4 LTS (older LTS, PHP 8.1 compatible)
- `7.3` for Symfony 7.3 (current stable, shorter support)
- Tags for specific releases

### Q: What if I want breaking changes?

**A:** Make them on `main` branch for next Symfony version. Old branches stay stable.

### Q: Can I delete old branches?

**A:** Archive them instead (make read-only). Users might still need them.

### Q: How often should I create tags?

**A:** Monthly, or when you have meaningful changes. Not for every Symfony patch.

### Q: What about non-LTS versions?

**A:** Support them short-term. Archive after EOL. Focus on LTS branches.

### Q: Should I use auto-tagging?

**A:** Optional. Manual tagging gives more control. Auto-tagging is convenient for frequent updates.

### Q: How do I handle hotfixes?

**A:** Apply to affected branches, cherry-pick as needed, create patch tags.

### Q: What if Symfony patch has critical security fix?

**A:** Update immediately, optionally create tag mentioning security fix.

### Q: Can users stay on specific tag forever?

**A:** Yes, but they won't get updates. Branches are better for ongoing projects.

---

## Quick Reference Commands

```bash
# Detect Symfony version
bin/detect-symfony-version

# Detect and show JSON
bin/detect-symfony-version --json

# Get next patch version
bin/detect-symfony-version --next-patch

# Create tag
bin/tag-version 6.4.1

# Create and push tag
bin/tag-version 6.4.1 --push

# List all tags
git tag -l

# List tags for specific version
git tag -l "6.4.*"

# Show tag details
git show 6.4.1

# Delete local tag
git tag -d 6.4.1

# Delete remote tag (careful!)
git push origin --delete 6.4.1

# Update short tag
git tag -f 6.4
git push -f origin 6.4

# Clone specific branch
git clone --branch 6.4 https://github.com/neuralglitch/skeleton.git

# Clone specific tag
git clone --branch 6.4.1 https://github.com/neuralglitch/skeleton.git

# Switch branches
git checkout 7.4

# Pull updates
git pull
```

---

## Additional Resources

- [Semantic Versioning](https://semver.org/)
- [Git Branching](https://git-scm.com/book/en/v2/Git-Branching-Branching-Workflows)
- [Git Tagging](https://git-scm.com/book/en/v2/Git-Basics-Tagging)
- [Symfony Releases](https://symfony.com/releases)
- [Symfony Roadmap](https://symfony.com/roadmap)
- [GitHub Releases](https://docs.github.com/en/repositories/releasing-projects-on-github)

---

<div align="center">

**Questions or issues?** [Open an issue](https://github.com/neuralglitch/skeleton/issues)

**Last updated:** October 2025

</div>
