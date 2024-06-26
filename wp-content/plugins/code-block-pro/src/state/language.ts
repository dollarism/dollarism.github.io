import { create } from 'zustand';
import { devtools, persist } from 'zustand/middleware';
import { Lang } from '../types';

type LanguageType = {
    previousLanguage: Lang;
    setPreviousLanguage: (language: Lang) => void;
    recentLanguages: Lang[];
    addRecentLanguage: (language: Lang) => void;
};
export const useLanguageStore = create<LanguageType>()(
    persist(
        devtools(
            (set, get) => ({
                previousLanguage: 'javascript' as Lang,
                setPreviousLanguage(language: Lang) {
                    set({ previousLanguage: language });
                    get().addRecentLanguage(language);
                },
                recentLanguages: [] as Lang[],
                addRecentLanguage(language: Lang) {
                    // Limit to the last 5
                    set((state) => {
                        if (state.recentLanguages.includes(language)) {
                            return state;
                        }
                        return {
                            recentLanguages: [
                                ...(state.recentLanguages?.slice(-4) || []),
                                language,
                            ],
                        };
                    });
                },
            }),
            { name: 'Code Block Pro Language' },
        ),
        { name: 'code-block-pro-last-language' },
    ),
);
