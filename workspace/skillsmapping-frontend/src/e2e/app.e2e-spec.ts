import { SkillsmappingFrontendPage } from './app.po';

describe('skillsmapping-frontend App', function() {
  let page: SkillsmappingFrontendPage;

  beforeEach(() => {
    page = new SkillsmappingFrontendPage();
  });

  it('should display message saying app works', () => {
    page.navigateTo();
    expect(page.getParagraphText()).toEqual('app works!');
  });
});
