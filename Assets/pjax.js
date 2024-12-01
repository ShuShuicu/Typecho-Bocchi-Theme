// 添加防抖函数
const debounce = (fn, delay) => {
  let timer = null;
  return function (...args) {
    if (timer) clearTimeout(timer);
    timer = setTimeout(() => fn.apply(this, args), delay);
  };
};

// initViewImage
const initViewImage = debounce(() => {
  try {
    if (window.ViewImage?.init) {
      ViewImage.init('#PostContent img');
    }
  } catch (error) {
    console.warn('ViewImage初始化失败:', error);
  }
}, 200);

// MDUI组件初始化函数
const initMDUI = () => {
  try {
    // 确保MDUI组件存在
    if (typeof mdui !== 'undefined') {
      // 初始化所有MDUI组件
      mdui.mutation();
      
      // 特别处理select组件
      const selects = document.querySelectorAll('.mdui-select:not(.mdui-select-initialized)');
      selects.forEach(select => {
        new mdui.Select(select);
      });
    }
  } catch (error) {
    console.warn('MDUI初始化失败:', error);
  }
};

class TxtType {
  constructor(el, toRotate, period) {
    if (!el || !toRotate) return;
    
    this.toRotate = toRotate;
    this.el = el;
    this.loopNum = 0;
    this.period = parseInt(period, 10) || 2000;
    this.txt = '';
    this.isDeleting = false;
    this.animationFrame = null;
    this.tick();
  }

  tick() {
    try {
      const i = this.loopNum % this.toRotate.length;
      const fullTxt = this.toRotate[i];

      this.txt = this.isDeleting
        ? fullTxt.substring(0, this.txt.length - 1)
        : fullTxt.substring(0, this.txt.length + 1);

      this.el.innerHTML = `<span class="wrap">${this.txt}</span>`;

      let delta = 200 - Math.random() * 100;

      if (this.isDeleting) {
        delta /= 2;
      }

      if (!this.isDeleting && this.txt === fullTxt) {
        delta = this.period;
        this.isDeleting = true;
      } else if (this.isDeleting && this.txt === '') {
        this.isDeleting = false;
        this.loopNum++;
        delta = 500;
      }

      this.animationFrame = requestAnimationFrame(() => {
        setTimeout(() => this.tick(), delta);
      });
    } catch (error) {
      console.warn('打字效果执行错误:', error);
    }
  }

  destroy() {
    if (this.animationFrame) {
      cancelAnimationFrame(this.animationFrame);
    }
  }
}

const initTypewrite = () => {
  try {
    // 清理之前的实例
    const oldElements = document.getElementsByClassName('typewrite');
    Array.from(oldElements).forEach(el => {
      if (el._txtType) {
        el._txtType.destroy();
      }
    });

    // 初始化新实例
    Array.from(oldElements).forEach(el => {
      const toRotate = el.getAttribute('data-type');
      const period = el.getAttribute('data-period');
      if (toRotate) {
        el._txtType = new TxtType(el, JSON.parse(toRotate), period);
      }
    });

    // 添加样式
    if (!document.querySelector('.typewrite-style')) {
      const css = document.createElement("style");
      css.className = 'typewrite-style';
      css.textContent = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
      document.body.appendChild(css);
    }
  } catch (error) {
    console.warn('Typewrite初始化失败:', error);
  }
};

// 初始化Clipboard.js
const initClipboard = () => {
  try {
    const clipboard = new ClipboardJS('.copy-btn'); // 假设按钮类名为copy-btn
    clipboard.on('success', (e) => {
      console.log('复制成功:', e.text);
      e.clearSelection();
    });
    clipboard.on('error', (e) => {
      console.warn('复制失败:', e);
    });
  } catch (error) {
    console.warn('Clipboard初始化失败:', error);
  }
};

// 优化后的initAll函数
const initAll = debounce(() => {
  try {
    const tasks = [
      initTypewrite,
      initViewImage,
      initMDUI,  // 使用新的初始化函数
      Prism.highlightAll, // hljs替代Prism
      initClipboard // 添加Clipboard.js初始化
    ];

    Promise.all(tasks.map(task => 
      new Promise(resolve => {
        try {
          task();
          resolve();
        } catch (error) {
          console.warn(`${task.name}初始化失败:`, error);
          resolve();
        }
      })
    )).catch(error => {
      console.error('组件初始化失败:', error);
    });
  } catch (error) {
    console.error('整体初始化失败:', error);
  }
}, 300);

// 打印Logo
printLogo();

// 监听DOM加载完成
document.addEventListener('DOMContentLoaded', initViewImage);

// 页面完全加载后初始化
window.onload = initAll;

// PJAX配置
const pjaxOptions = {
  container: '#app',
  fragment: '#app',
  timeout: 8000
};

// 设置翻译请求监听器
translate.request.listener.delayExecuteTime = 500; // 设置请求完毕后等待500毫秒再翻译
translate.request.listener.minIntervalTime = 800; // 设置两次翻译的最小间隔时间为800毫秒

translate.request.listener.trigger = function(url) {
  // 这里可以自定义哪些URL会触发翻译
  return true; // 默认所有URL都触发翻译
};

// 启动翻译请求监听器
translate.request.listener.start();

// 过滤掉所有 <i> 标签的内容并添加忽略翻译的 class
const filterITagsContent = () => {
  const iTags = document.querySelectorAll('i');
  iTags.forEach(tag => {
    tag.classList.add('ignore-translate'); // 添加忽略翻译的 class
  });
};

// 设置忽略翻译的 class
translate.ignore.class = [
  'ignore-translate',
  'mdui-btn',
  'mdui-btn-icon',
  'mdui-list-item-icon',
  'mdui-icon',
  'material-icons'
];

// PJAX事件处理
$(document)
  .pjax(
    `a[href^="${window.location.origin}"]:not(a[target="_blank"], a[no-pjax], button[no-pjax])`,
    pjaxOptions
  )
  .on('pjax:send', () => {
    NProgress.start();
  })
  .on('pjax:complete', () => {
    NProgress.done();
    initAll();
    filterITagsContent(); // 在翻译前过滤 <i> 标签内容
    translate.execute(); // 在PJAX完成后执行翻译
  })
  .on('pjax:error', (xhr, textStatus, error) => {
    console.error('PJAX加载失败:', error);
    NProgress.done();
    mdui.snackbar({
      message: '页面加载失败，请刷新重试',
      timeout: 2000,
      position: 'bottom'
    });
  });

// 查看当前忽略的 class
console.log(translate.ignore.class);

  if (typeof translate !== 'undefined') {
    translate.language.setDefaultTo('chinese_simplified');
    translate.selectLanguageTag.show = false;
    translate.service.use('client.edge');
    
    translate.language.setUrlParamControl('lang'); // URL参数翻译
    translate.setAutoDiscriminateLocalLanguage(); // 默认翻译为当前国家语言
    translate.execute(); // 整页翻译
    // translate.selectionTranslate.start(); // 弃用
  }